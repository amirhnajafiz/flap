# Changelog

- Approach 1: Sidecar container
  * Run tracing container as sidecar container in the same pod
  * Tracing container must share host PID
  * Difficult to schedule regular sidecar container to run before main container

- Approach 2: Sidecar init container
  * Run tracing container as init sidecar container in the same pod
  * Sidecar init containers always run before the main container and persist if `restart: Always`
  * Still difficult to obtain PID of root process in main container
  * Trace process in main container by name instead
  * Still unable to capture certain vllm I/O requests

- Approach 3: Cgroups
  * Run tracing on host rather than as a container
  * Find containerid of container using `crictl`
  * Find cgroup corresponding to a certain containerid by searching `/sys/fs/cgroup`
  * Filter processes in bpftrace using the cgroup
  
- Approach 4: Daemonset (WIP)
  * Run tracing as a daemonset container within the host
  * Easier to ensure tracing running before process
  * Difficult to differentiate between the same process in different replica pods

