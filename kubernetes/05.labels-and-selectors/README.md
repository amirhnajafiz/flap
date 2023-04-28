# Labels & Selectors

## Labels

```Labels``` are key/value pairs that are attached to objects, such as pods.
Labels are intended to be used to specify identifying attributes of objects that are meaningful and relevant to users,
but do not directly imply semantics to the core system.
Labels can be used to organize and to select subsets of objects.
Labels can be attached to objects at creation time and subsequently added and modified at any time.
Each object can have a set of key/value labels defined.
Each Key must be unique for a given object.

### Example

```yml
apiVersion: v1
kind: Pod
metadata:
  name: label-demo
  labels:
    environment: production
    app: nginx
spec:
  containers:
  - name: nginx
    image: nginx:1.14.2
    ports:
    - containerPort: 80
```

## Selector

Via a ```label selector```, the client/user can identify a set of objects.
The label selector is the core grouping primitive in Kubernetes.

### Example

```yml
apiVersion: v1
kind: Pod
metadata:
  name: cuda-test
spec:
  containers:
    - name: cuda-test
      image: "registry.k8s.io/cuda-vector-add:v0.1"
      resources:
        limits:
          nvidia.com/gpu: 1
  nodeSelector:
    accelerator: nvidia-tesla-p100
```

```sh
kubectl get pods -l environment=production,tier=frontend
```

```sh
kubectl get pods -l 'environment in (production),tier in (frontend)'
```

```sh
selector:
  matchLabels:
    component: redis
  matchExpressions:
    - { key: tier, operator: In, values: [cache] }
    - { key: environment, operator: NotIn, values: [dev] }
```
