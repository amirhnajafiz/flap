# file: scripts/gen_bpftrace.py
# generating bpftrace scripts by reading the j2 files in `templates` directory.

import json
import logging
import os

from jinja2 import Template

CONFIG_PATH = "tracers.json"


def import_json(path: str) -> dict:
    """Import json data into a dictionary.

    :param path: path to the json file
    """
    data = {}
    with open(path, "r") as file:
        data = json.load(file)
    return data


def read_to_str(path: str) -> str:
    """Read a file data into a string.

    :param path: file path
    :return str: file content
    """
    try:
        data = ""
        with open(path, "r") as file:
            data = file.read()
        return data
    except Exception:
        return ""


def read_template(path: str) -> Template:
    """Read template into jinja2 object.

    :param path: jinja2 template
    :return jinja2.Template: the template object
    """
    return Template(open(path).read())


def save_template(out: str, data: str) -> None:
    """Save the templates into files.

    :param path: output path
    :param data: content to write
    """
    with open(out, "w") as file:
        file.write(data)


if __name__ == "__main__":
    # load the configs
    cfg = import_json(CONFIG_PATH)

    logging.basicConfig(
        level=logging.INFO,
        format="%(asctime)s - %(levelname)s - %(message)s",
        datefmt="%Y-%m-%d %H:%M:%S",
    )
    logging.info(f"loading templates from {CONFIG_PATH}")

    # form the template paths
    templates_dir_path = os.path.join(cfg["templates_dir"], cfg["sources_dir"])

    # generate bpftrace scripts by going through inputs and sources
    for entry in cfg["inputs"]:
        logging.info(f"generating tracing templates for {entry}")

        # form the paths
        dir_path = os.path.join(cfg["templates_dir"], cfg["inputs_dir"], entry)
        filter_path = os.path.join(dir_path, "filter.bt")
        begin_path = os.path.join(dir_path, "begin.bt")
        output_dir_path = os.path.join(cfg["outputs_dir"], entry)

        os.makedirs(output_dir_path, exist_ok=True)

        # read inputs
        filter_section = read_to_str(filter_path)
        begin_section = read_to_str(begin_path)

        # create the outputs
        for out in cfg["sources"]:
            logging.info(f"exporting script {entry} : {out}")

            # form the paths
            template_path = os.path.join(templates_dir_path, out) + ".j2"
            output_path = os.path.join(output_dir_path, out)

            tmp = read_template(template_path)
            res = tmp.render(begin_section=begin_section, filter=filter_section)

            save_template(output_path, res)
            logging.info(f"template saved: {output_path}")

    logging.info("done")
