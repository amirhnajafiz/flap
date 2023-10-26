# Debugging Pods

The Kubernetes-native answer to debugging running containers is to use kubectl debug.
The debug command spins up a new container into a running pod.
This new container can run as a different user and from any image you choose.
Because the debug container runs within the same pod as the container it targets (and therefore on the same node),
the isolation between both containers does not need to be absolute.
The debug container can share system resources with other containers running in the same pod.

## commands

```shell
kubectl debug -it \
--container=debug-container \
--image=alpine \
--target=postcont \
postpod
```

## links

- [K8S debugging](https://kubernetes.io/docs/tasks/debug/debug-application/debug-running-pod/)
