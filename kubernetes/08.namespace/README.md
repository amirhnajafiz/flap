# Namespaces

In Kubernetes, ```namespaces``` provides a mechanism for isolating groups of resources within a single cluster.
Names of resources need to be unique within a namespace, but not across namespaces.
Namespace-based scoping is applicable only for namespaced objects (e.g. Deployments, Services, etc)
and not for cluster-wide objects (e.g. StorageClass, Nodes, PersistentVolumes, etc).

- Default
- Kube-node-lease
- Kube-system
- Kube-public

## Example

```sh
kubectl run nginx --image=nginx --namespace=<insert-namespace-name-here>
kubectl get pods --namespace=<insert-namespace-name-here>
```

```sh
kubectl config set-context --current --namespace=<insert-namespace-name-here>
kubectl config view --minify | grep namespace:
```

## DNS

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

When several users or teams share a cluster with a fixed number of nodes,
there is a concern that one team could use more than its fair share of resources.
```Resource quotas``` are a tool for administrators to address this concern.

```shell
kubectl create -f compute-quota.yml
```

Read more in [here](https://kubernetes.io/docs/concepts/policy/resource-quotas/).
