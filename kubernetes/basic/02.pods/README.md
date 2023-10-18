# Pods

Pods are the smallest deployable units of computing that you can create and manage in Kubernetes.
A Pod (as in a pod of whales or pea pod) is a group of one or more containers, with shared storage and network resources, and a specification for how to run the containers. 

## example

```yml
apiVersion: v1
kind: Pod
metadata:
  name: nginx
spec:
  containers:
  - name: nginx
    image: nginx:1.14.2
    env:
      - name: PORT
        value: "80"
    ports:
    - containerPort: 80
```

## commands

get all pods:

```sh
kubectl get pods
```

deploy a pods:

```sh
kubectl apply -f pod.yaml
```

describe a pod:

```sh
kubectl describe pod nginx
```

## links

- [Pod lifecycle](https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle/)
