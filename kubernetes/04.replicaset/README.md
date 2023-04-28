# Replica Set

A ```ReplicaSet```'s purpose is to maintain a stable set of replica Pods running at any given time.
As such, it is often used to guarantee the availability of a specified number of identical Pods.

## Example

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
it can acquire other Pods in the manner specified in the previous sections.

```shell
kubectl create -f replicaset-definition.yml
```

```shell
kubectl get replicaset
```

## HPA

A ```ReplicaSet``` can also be a target for ```Horizontal Pod Autoscalers``` (HPA).
That is, a ```ReplicaSet``` can be auto-scaled by an ```HPA```.

### Example

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

```sh
kubectl autoscale rs frontend --max=10 --min=3 --cpu-percent=50
```
