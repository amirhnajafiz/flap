<h1 align="center">
    Namespaces
</h1>

<br />

- Default
- Kube-system
- Kube-public

### DNS

```shell
[service name].[namespace].[service].[domain]
db-service.dev.svc.cluster.local
```

```shell
kubectl get pods --namespace=kube-system
```

```yaml
apiVersion: v1
kind: Pod

metadata:
    name: myapp-pod
    namespace: dev
    ...
```

```shell
kubectl create -f namespace-dev.yml
```

```shell
kubectl create namespace dev
```

```shell
kubectl config set-context $(kubectl config current-context) --namespace=dev
```

```shell
kubectl get pods --all-namespaces
```

```shell
kubectl run redis --image=redis --dry-run=client -o yaml > pod.yml
kubectl apply -f pod.yml
```

```shell
kubectl get pods -n=dev
```

## Resource Quota

```shell
kubectl create -f compute-quota.yml
```
