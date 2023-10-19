# ReplicaSet

A ```ReplicaSet```'s purpose is to maintain a stable set of replica Pods running at any given time.
As such, it is often used to guarantee the availability of a specified number of identical Pods.
A ```Deployment``` is a higher-level concept that manages ReplicaSets and provides declarative updates to Pods
along with a lot of other useful features.

## example

```yml
apiVersion: apps/v1
kind: ReplicaSet
metadata:
  name: frontend
  labels:
    app: guestbook
    tier: frontend
spec:
  # modify replicas according to your case
  replicas: 3
  selector:
    matchLabels:
      tier: frontend
  template:
    metadata:
      labels:
        tier: frontend
    spec:
      containers:
      - name: php-redis
        image: gcr.io/google_samples/gb-frontend:v3
```

```ReplicaSet``` is not limited to owning Pods specified by its template,
it can acquire other Pods in the manner specified in their metadata.

### commands

```shell
kubectl create -f replicaset-definition.yml
```

```shell
kubectl get replicaset/rs
```

## HPA

A ```ReplicaSet``` can also be a target for ```Horizontal Pod Autoscalers``` (HPA).
That is, a ```ReplicaSet``` can be auto-scaled by an ```HPA```.

### example

```yml
apiVersion: autoscaling/v1
kind: HorizontalPodAutoscaler
metadata:
  name: frontend-scaler
spec:
  scaleTargetRef:
    kind: ReplicaSet
    name: frontend
  minReplicas: 3
  maxReplicas: 10
  targetCPUUtilizationPercentage: 50
```

### commands

```sh
kubectl autoscale rs frontend --max=10 --min=3 --cpu-percent=50
```

## HPA vs Replicaset

Based on the collected resource usage, HPA will calculate the desired number of replicas required.
Then, HPA decides to scale up the application to the desired number of replicas.
Finally, HPA changes the desired number of replicas.

### HPA vs VPA

The HPA ensures that the application has enough resources to handle the workload and that the cluster
can handle spikes in traffic. The VPA, on the other hand, adjusts the CPU and memory requests and limits
of the pods based on their actual resource usage.

## links

- [K8S replicaset](https://kubernetes.io/docs/concepts/workloads/controllers/replicaset/)
