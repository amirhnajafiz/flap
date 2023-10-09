# Readiness and Liveness

The kubelet uses liveness probes to know when to restart a container.
For example, liveness probes could catch a deadlock, where an application is running, but unable to make progress.
Restarting a container in such a state can help to make the application more available despite bugs.

The kubelet uses readiness probes to know when a container is ready to start accepting traffic.
A Pod is considered ready when all of its containers are ready. One use of this signal is to control
which Pods are used as backends for Services. When a Pod is not ready, it is removed from Service load balancers.

## example

```yaml
apiVersion: v1
kind: Pod
metadata:
  labels:
    test: liveness
  name: liveness-exec
spec:
  containers:
  - name: liveness
    image: registry.k8s.io/busybox
    args:
    - /bin/sh
    - -c
    - touch /tmp/healthy; sleep 30; rm -f /tmp/healthy; sleep 600
    livenessProbe:
      exec:
        command:
        - cat
        - /tmp/healthy
      initialDelaySeconds: 5
      periodSeconds: 5
```
