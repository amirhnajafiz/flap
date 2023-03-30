<h1 align="center">
    Deployment
</h1>

<br />

Each deployment, creates a replicaset which creates pods.

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
