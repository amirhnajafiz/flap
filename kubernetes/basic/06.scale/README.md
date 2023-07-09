# Scale

Set a new size for a Replication Controller, Job, or Deployment.

## Example

```shell
kubectl replace -f replicaset-definition.yml
```

```shell
kubectl scale --replicas=6 -f replicaset-definition.yml
```

```shell
kubectl scale --replicas=6 replicaset myapp-replicaset
```

## HPA

In Kubernetes, a ```HorizontalPodAutoscaler``` automatically updates a workload resource (such as a Deployment or StatefulSet),
with the aim of automatically scaling the workload to match demand.

Horizontal scaling means that the response to increased load is to deploy more Pods.
This is different from vertical scaling, which for Kubernetes would mean assigning more resources
(for example: memory or CPU) to the Pods that are already running for the workload.
