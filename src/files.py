import os
import shutil


def create_dir(directory: str):
    """Force create a new directory (delete existing and create new one).

    :param directory: target directory path
    """
    if os.path.isdir(directory):
        shutil.rmtree(directory)
    os.makedirs(directory, exist_ok=True)


def get_tracing_scripts(dir_path: str) -> dict[str:str]:
    """Return the path of tracing scripts based on input directory path.

    :param dir_path: base directory of the target tracer
    """
    return {
        "io": os.path.join(dir_path, "io_trace.bt"),
        "memory": os.path.join(dir_path, "memory_trace.bt"),
    }
