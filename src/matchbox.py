import logging

from src.files import create_dir
from src.timestamp import export_reference_timestamps
from src.tracer import Tracer


def ignite_tracing(output_dir: str, tracers: list[Tracer]):
    """Start the tracers.

    :param output_dir: the output directory to store tracing results
    :param tracers: a list of tracers to run
    """
    # create the output directory
    create_dir(output_dir)
    logging.debug("output directory initialized")

    # store the reference timestamps to convert raw clock numbers to datetime
    export_reference_timestamps(output_dir)
    logging.debug("reference timestamps exported")

    # loop over tracers and start
    for tracer in tracers:
        logging.info(f"starting {tracer.name()} ...")
        tracer.start()
    
    logging.info("all tracers started")

    # wait for all tracers
    for tracer in tracers:
        tracer.wait()


def extinguish_tracing(tracers: list[Tracer]):
    """Stop all tracers.

    :param tracers: a list of running tracers
    """

    # return a handle_shutdown function to bind it to termination signals
    def handle_shutdown(signum, _):
        if signum is not None:
            logging.info(f"received signal {signum}, shutting down safely ...")

        # loop over tracers and stop them
        for tracer in tracers:
            logging.info(f"stopping {tracer.name()} ...")
            tracer.stop()
        
        logging.info("all tracers stopped")

    return handle_shutdown
