# Multi container pods

Containers in a Pod runs on a "logical host": they use the same network namespace (same IP address and port space),
IPC namespace and, optionally, they can use shared volumes.
Therefore, these containers can efficiently communicate, ensuring data locality.
Also, Pods allow managing several tightly coupled application containers as a single unit.

The primary purpose of a multi-container Pod is to support co-located, co-managed helper processes for a main program.
There are some general patterns of using helper processes in Pods:

- Sidecar containers
- Proxies, bridges, adapters
- Ambassador pattern

Containers in a Pod share the same IPC namespace and they can also communicate with each other using standard inter-process
communications like SystemV semaphores or POSIX shared memory. Containers in a Pod are accessible via "localhost",
they use the same network namespace.

## example

```yaml
apiVersion: v1
kind: Pod
metadata:
  name: mc1
spec:
  volumes:
  - name: html
    emptyDir: {}
  containers:
  - name: 1st
    image: nginx
    volumeMounts:
    - name: html
      mountPath: /usr/share/nginx/html
  - name: 2nd
    image: debian
    volumeMounts:
    - name: html
      mountPath: /html
    command: ["/bin/sh", "-c"]
    args:
      - while true; do
          date >> /html/index.html;
          sleep 1;
        done
```

## why using it?

- Efficient Collaboration: They support multiple containers working closely together, making them ideal for applications with interconnected components.
- Streamlined Management: All containers within a Pod start, stop, and update together, simplifying operational tasks.
- Shared Resources: Resource allocation is collective, ensuring a balanced distribution among containers.
- Effective Communication: Containers in the same Pod can efficiently exchange data, reducing network overhead.
- Consistency in Updates: Updates are synchronized across all containers in the Pod, reducing version conflicts.

## links

- [Multi-containers](https://k21academy.com/docker-kubernetes/multi-container-pods/)
