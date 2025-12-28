from src.files import get_tracing_scripts
from src.tracer import MonoTracer, RotateTracer, Tracer
from src.utils import ensure_script


def handle_execute(
    output_dir: str,
    execute: str,
    rotate: bool = False,
    rotate_size: int = 100 * 1024 * 1024,
) -> list[Tracer]:
    """Handle the execute command.

    running: bpftrace -o output -c "command" bpftrace/execute/<tracer>.bt

    :param output_dir: tracing output directory
    :param execute: the command to execute
    :param rotate: enable rotate tracing
    :param rotate_size: set the rotation size
    :return: list of tracing scripts
    """
    tracers = []

    for tname, tpath in get_tracing_scripts("bpftrace/execute").items():
        tracer = __new_tracer(tname, tpath, output_dir, rotate, rotate_size)
        tracer.with_options(["-c", execute])
        tracers.append(tracer)

    return tracers


def handle_pid(
    output_dir: str,
    pid: str,
    rotate: bool = False,
    rotate_size: int = 100 * 1024 * 1024,
) -> list[Tracer]:
    """Handle the pid tracing.

    running: bpftrace -o output bpftrace/pid/<tracer>.bt <pid>

    :param output_dir: tracing output directory
    :param pid: the pid to trace
    :param rotate: enable rotate tracing
    :param rotate_size: set the rotation size
    :return: list of tracing scripts
    """
    tracers = []

    for tname, tpath in get_tracing_scripts("bpftrace/pid").items():
        tracer = __new_tracer(tname, tpath, output_dir, rotate, rotate_size)
        tracer.with_args([pid])
        tracers.append(tracer)

    return tracers


def handle_command(
    output_dir: str,
    command: str,
    rotate: bool = False,
    rotate_size: int = 100 * 1024 * 1024,
) -> list[Tracer]:
    """Handle the command tracing.

    running: bpftrace -o output bpftrace/command/<tracer>.bt <command>

    :param output_dir: tracing output directory
    :param command: the command to trace
    :param rotate: enable rotate tracing
    :param rotate_size: set the rotation size
    :return: list of tracing scripts
    """
    tracers = []

    for tname, tpath in get_tracing_scripts("bpftrace/command").items():
        tracer = __new_tracer(tname, tpath, output_dir, rotate, rotate_size)
        tracer.with_args([command])
        tracers.append(tracer)

    return tracers


def handle_cgroup_and_command(
    output_dir: str,
    cgid: str,
    filter_command: str,
    rotate: bool = False,
    rotate_size: int = 100 * 1024 * 1024,
) -> list[Tracer]:
    """Handle the cgroup and command tracing.

    running: bpftrace -o output bpftrace/cgroup_and_command/<tracer>.bt <cgroup> <command>

    :param output_dir: tracing output directory
    :param cgid: the cgroup to trace
    :param filter_command: the command to filter
    :param rotate: enable rotate tracing
    :param rotate_size: set the rotation size
    :return: list of tracing scripts
    """
    tracers = []

    for tname, tpath in get_tracing_scripts("bpftrace/cgroup_and_command").items():
        tracer = __new_tracer(tname, tpath, output_dir, rotate, rotate_size)
        tracer.with_args([cgid, filter_command])
        tracers.append(tracer)

    return tracers


def handle_cgroup(
    output_dir: str,
    cgid: str,
    rotate: bool = False,
    rotate_size: int = 100 * 1024 * 1024,
) -> list[Tracer]:
    """Handle the cgroup tracing.

    running: bpftrace -o output bpftrace/cgroup/<tracer>.bt <cgroup>

    :param output_dir: tracing output directory
    :param cgid: the cgroup to trace
    :param rotate: enable rotate tracing
    :param rotate_size: set the rotation size
    :return: list of tracing scripts
    """
    tracers = []

    for tname, tpath in get_tracing_scripts("bpftrace/cgroup").items():
        tracer = __new_tracer(tname, tpath, output_dir, rotate, rotate_size)
        tracer.with_args([cgid])
        tracers.append(tracer)

    return tracers


def __new_tracer(
    name: str, path: str, output_dir: str, rotate: str, rotate_size: int
) -> Tracer:
    """Create a new tracer based on the inputs.
    it also checks if the tracer script exists.
    """
    ensure_script(path)

    if rotate:
        tracer = RotateTracer(name, path, output_dir)
        tracer.with_rotate_size(rotate_size=rotate_size)
    else:
        tracer = MonoTracer(name, path, output_dir)

    return tracer
