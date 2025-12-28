import logging
import os
import subprocess
import threading
import time
from abc import ABC


class Tracer(ABC):
    """Tracer runs bpftrace scripts."""

    def __init__(
        self, tid: str, script: str, output_dir: str, termination_timeout: int = 2
    ):
        """Tracer constructor.

        :param tid: the tracer id for debugging
        :param script: the bpftrace script to run
        :param output_dir: the output directory to export logs
        :param termination_timeout: tracer termination timeout in seconds
        """
        self._tid = tid  # tracer id
        self._script = script  # bpftrace script
        self._tto = termination_timeout
        self._output_dir = output_dir

        self._options = []  # bpftrace options
        self._args = []  # bpftrace input arguments

        self._stop_event = None
        self._t = None

    def with_options(self, options: list[str]):
        """
        Add options to the tracer.

        :param options: a list of options to append the current options
        """
        self._options += options

    def with_args(self, args: list[str]):
        """
        Add args to the tracer.

        :param args: a list of args to append the current args
        """
        self._args += args

    def start(self):
        """Start a tracer by calling the __start_tracer in a thread."""
        self._stop_event = threading.Event()
        self._t = threading.Thread(target=self.start_tracer, args=(), daemon=True)
        self._t.start()

    def stop(self):
        """Stop the tracer by terminating its process and thread."""
        self._stop_event.set()
        if self._t:
            self._t.join()

    def wait(self):
        """Wait for the tracing process to finish."""
        if self._t:
            self._t.join()

    def name(self) -> str:
        """Get the name of the tracer."""
        return self._tid

    @classmethod
    def start_tracer(self):
        pass


class MonoTracer(Tracer):
    """Tracer runs bpftrace in a separate thread with output by bpftrace."""

    def start_tracer(self):
        """Start tracer in a new process and wait until its over or the stop event is received."""
        self.with_options(
            ["-o", os.path.join(self._output_dir, f"trace_{self._tid}_0.log")]
        )

        # create the bpftrace command
        bt_command = ["bpftrace"] + self._options + [self._script] + self._args

        logging.debug(
            "[{}] starting tracer: {}".format(self._tid, " ".join(bt_command))
        )

        try:
            # run a new process
            proc = subprocess.Popen(bt_command)

            while proc.poll() is None:
                if self._stop_event.is_set():
                    logging.debug(f"[{self._tid}] stopping tracer")
                    proc.terminate()
                    try:
                        logging.debug(f"[{self._tid}] waiting for {self._tto}s")
                        proc.wait(timeout=self._tto)
                    except subprocess.TimeoutExpired:
                        logging.debug(f"[{self._tid}] killing tracer")
                        proc.kill()
                    return
                time.sleep(0.2)
        except Exception as e:
            logging.error(f"[{self._tid}] failed: {e}")
        finally:
            logging.debug(f"[{self._tid}]  exiting tracer")


class RotateTracer(Tracer):
    """Tracer runs bpftrace in a separate thread with output log rotation."""

    def with_rotate_size(
        self,
        rotate_size: int = 100 * 1024 * 1024,
    ):
        """With rotate size limit (default is 100Mb per file).

        :param rotate_size: the file size for rotate
        """
        self._rotate_size = rotate_size
        self._file_index = 0
        self._current_size = 0
        self._f = None

    def __open_new_file(self):
        """Rotate output file."""
        if self._f:
            self._f.close()

        filename = os.path.join(
            self._output_dir, f"trace_{self._tid}_{self._file_index}.log"
        )
        logging.info(f"[{self._tid}] rotating to {filename}")

        self._f = open(filename, "w", buffering=1)  # line-buffered
        self._current_size = 0
        self._file_index += 1

    def __write_line(self, line: str):
        data = line.encode()
        if self._current_size + len(data) > self._rotate_size:
            self.__open_new_file()

        self._f.write(line)
        self._current_size += len(data)

    def start_tracer(self):
        """Start bpftrace and rotate logs while reading stdout."""
        bt_cmd = ["bpftrace"] + self._options + [self._script] + self._args

        logging.debug(f"[{self._tid}] starting tracer: {' '.join(bt_cmd)}")

        # setup first output file
        self.__open_new_file()

        try:
            proc = subprocess.Popen(
                bt_cmd,
                stdout=subprocess.PIPE,
                stderr=subprocess.PIPE,
                text=True,
                bufsize=1,  # line-buffered read
            )

            # read until process ends or stop requested
            while True:
                if self._stop_event.is_set():
                    logging.debug(f"[{self._tid}] stopping tracer")
                    proc.terminate()
                    try:
                        proc.wait(timeout=self._tto)
                    except subprocess.TimeoutExpired:
                        logging.debug(f"[{self._tid}] killing tracer")
                        proc.kill()
                    break

                # non-blocking line read
                line = proc.stdout.readline()
                if not line:
                    # process probably exited
                    if proc.poll() is not None:
                        break
                    time.sleep(0.05)
                    continue

                # write line safely with rotation
                self.__write_line(line)
        except Exception as e:
            logging.error(f"[{self._tid}] tracer failed: {e}")
        finally:
            if self._f:
                self._f.close()
            logging.debug(f"[{self._tid}] exiting tracer")
