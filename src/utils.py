import logging
import os
import shutil
import sys


def must_support_bpftrace():
    """Check if bpftrace is supported."""
    if shutil.which("bpftrace") is None:
        logging.error("bpftrace not found in PATH. Please install bpftrace.")
        sys.exit(3)


def ensure_script(path: str):
    """Check if the target script exists.

    :param path: the target script path
    """
    if not os.path.isfile(path):
        logging.error(f"required script '{path}' not found.")
        sys.exit(4)
