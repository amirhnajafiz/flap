<h1 align="center">
    Scale
</h1>

<br />

```shell
kubectl replace -f replicaset-definition.yml
```

```shell
kubectl scale --replicas=6 -f replicaset-definition.yml
```

```shell
kubectl scale --replicas=6 replicaset myapp-replicaset
```
