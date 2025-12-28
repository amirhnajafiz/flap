import argparse
import logging
import os
import signal
import sys

import src.handlers as hd
from src.containers import find_pod_cgroup
from src.matchbox import extinguish_tracing, ignite_tracing
from src.utils import must_support_bpftrace


def process(args: argparse.Namespace):
    """Process user inputs."""

    # extract Kubernetes data
    ns = args.namespace
    pod = args.pod
    container = args.container

    # find the cgroup
    cgroup = find_pod_cgroup(namespace=ns, pod=pod, container=container)
    if len(cgroup) == 0:
        logging.error("empty cgroup returned!")
        sys.exit(1)

    # get tracers based on input
    tracers = []
    if args.filter_command:
        logging.info(
            f"tracing {args.container}/{args.filter_command} in {args.namespace}/{args.pod}"
        )
        tracers = hd.handle_cgroup_and_command(
            args.out, cgroup, args.filter_command, args.rotate, args.rotate_size
        )
    else:
        logging.info(f"tracing {args.container} in {args.namespace}/{args.pod}")
        tracers = hd.handle_cgroup(args.out, cgroup, args.rotate, args.rotate_size)

    # set the termination handlers
    signal.signal(signal.SIGINT, extinguish_tracing(tracers=tracers))
    signal.signal(signal.SIGTERM, extinguish_tracing(tracers=tracers))

    # start tracers
    ignite_tracing(output_dir=args.out, tracers=tracers)


def init_vars(args: argparse.Namespace):
    os.environ["BPFTRACE_MAX_STRLEN"] = args.max_str_len
    logging.basicConfig(
        level=logging.DEBUG if args.debug else logging.INFO,
        format="%(asctime)s - %(name)s - %(levelname)s - %(message)s",
    )


def main():
    # create an argument parser
    parser = argparse.ArgumentParser(
        description="Bootstraps a tracing session for a pod/container."
    )

    parser.add_argument(
        "-c", "--container", required=True, help="Container name inside the pod"
    )
    parser.add_argument("-p", "--pod", required=True, help="Pod name")
    parser.add_argument(
        "-ns", "--namespace", required=True, help="Kubernetes namespace of the Pod"
    )
    parser.add_argument(
        "-fc",
        "--filter_command",
        help="Specific command to trace inside the container (lower overhead)",
    )
    parser.add_argument(
        "-o",
        "--out",
        default="logs",
        help="Folder path to export the tracing logs (default: logs)",
    )
    parser.add_argument(
        "-mxsl",
        "--max_str_len",
        default="150",
        help="bpf MAX_STRLEN in bytes (default: 150)",
    )
    parser.add_argument(
        "-d",
        "--debug",
        action="store_true",
        help="Enable debug mode (print debug messages)",
    )
    parser.add_argument(
        "-r",
        "--rotate",
        action="store_true",
        help="Enable log rotation (useful to break large tracing log output)",
    )
    parser.add_argument(
        "-rs",
        "--rotate_size",
        type=int,
        default=100 * 1024 * 1024,
        help="Setting the rotate size (default is 100MB)",
    )

    # parse the arguments
    args = parser.parse_args()

    # init variables
    init_vars(args=args)

    logging.info(f"configs:\n\t{vars(args)}")

    # start processing the input
    process(args=args)


if __name__ == "__main__":
    must_support_bpftrace()
    main()
