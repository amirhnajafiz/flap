import json
import logging
import os
import time


def export_reference_timestamps(output_dir: str):
    """Print and write reference timestamps.

    :param output_dir: the output directory to write timestamps.json file
    """
    # get the time reference
    ref_wall = time.time()
    try:
        with open("/proc/uptime") as f:
            ref_mono = float(f.read().split()[0])
    except Exception:
        ref_mono = None

    logging.info(
        f"using parameters for timestamp converts:\n\tref wall: {ref_wall}\n\tref mono: {ref_mono}"
    )

    # store the reference timestamps
    meta_file = os.path.join(output_dir, "reference_timestamps.json")
    with open(meta_file, "w") as mf:
        json.dump({"ref_wall": ref_wall, "ref_mono": ref_mono}, mf, indent=2)

    logging.info("reference timestamps saved to: %s", meta_file)
