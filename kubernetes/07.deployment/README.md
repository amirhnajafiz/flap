# Deployment

A ```Deployment``` provides declarative updates for ```Pods``` and ```ReplicaSets```.

You describe a desired state in a Deployment, and the Deployment Controller changes the actual state to the desired
state at a controlled rate. You can define Deployments to create new ReplicaSets,
or to remove existing Deployments and adopt all their resources with new Deployments.

Each deployment, creates a replicaset which creates pods.

## Example

```yml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: nginx-deployment
  labels:
    app: nginx
spec:
  replicas: 3
  selector:
    matchLabels:
      app: nginx
  template:
    metadata:
      labels:
        app: nginx
    spec:
      containers:
      - name: nginx
        image: nginx:1.14.2
        ports:
        - containerPort: 80
```

```shell
kubectl create -f deployment-definition.yml
```

```shell
kubectl get all
```

```shell
kubectl get deployments
```

```shell
kubectl create deployment httpd-frontend --image=httpd:2.4-alpine
kubectl scale deployment --replicas=3 httpd-frontend
```
