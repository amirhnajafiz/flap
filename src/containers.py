import logging
import subprocess
import sys
import time


def find_pod_cgroup(namespace: str, pod: str, container: str) -> str:
    """Find pod's cgroup based on its namespace, name, and container using crictl.

    :param namespace: kubernetes namespace
    :param pod: kubernetes pod name
    :param container: kubernetes pod's container name
    :return: container cgroup
    """

    # poll for the container ID
    while True:
        logging.info("waiting ...")
        try:
            result = subprocess.run(
                ["crictl", "ps", "--namespace", namespace],
                capture_output=True,
                text=True,
                check=True,
            )
        except subprocess.CalledProcessError as exc:
            logging.error(f"error running crictl ps: {exc}")
            sys.exit(1)

        containerid = None
        for line in result.stdout.splitlines()[1:]:
            parts = line.split()

            if len(parts) >= 11 and parts[9] == pod and parts[6] == container:
                containerid = parts[0]
                break

        if containerid:
            logging.info(f"target container found: {container} => {containerid}")
            break

        time.sleep(0.5)

    # find cgroup path
    try:
        find_proc = subprocess.run(
            ["find", "/sys/fs/cgroup/", "-type", "d", "-name", f"*{containerid}*"],
            capture_output=True,
            text=True,
            check=True,
        )
        path = find_proc.stdout.strip().splitlines()[0]
    except Exception as e:
        logging.error(f"could not find cgroup path: {e}")
        sys.exit(1)

    # find numeric cgroupid
    try:
        stat_proc = subprocess.run(
            ["stat", "-c", "%i", path], capture_output=True, text=True, check=True
        )
        cgroupid = stat_proc.stdout.strip()
        return cgroupid
    except Exception as e:
        logging.error(f"could not determine cgroupid for {path}: {e}")
        sys.exit(1)

    return ""
