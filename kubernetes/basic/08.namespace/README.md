# Namespaces

In Kubernetes, ```namespaces``` provides a mechanism for isolating groups of resources within a single cluster.
Names of resources need to be unique within a namespace, but not across namespaces.
Namespace-based scoping is applicable only for namespaced objects (e.g. Deployments, Services, etc)
and not for cluster-wide objects (e.g. StorageClass, Nodes, PersistentVolumes, etc).

- Default
- Kube-node-lease
- Kube-system
- Kube-public

## example (commands)

```sh
kubectl run nginx --image=nginx --namespace=<insert-namespace-name-here>
kubectl get pods --namespace=<insert-namespace-name-here>
```

```sh
kubectl config set-context --current --namespace=<insert-namespace-name-here>
kubectl config view --minify | grep namespace:
```

## DNS

Kubernetes creates DNS records for Services and Pods. You can contact Services with consistent DNS names instead of IP addresses.
Services defined in the cluster are assigned DNS names. By default, a client Pod's DNS search list includes the Pod's
own namespace and the cluster's default domain.
DNS queries may be expanded using the Pod's ```/etc/resolv.conf```. Kubelet configures this file for each Pod.
For example, a query for just data may be expanded to ```data.test.svc.cluster.local```.
The values of the search option are used to expand queries.

### commands

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

### example

```yaml
apiVersion: v1
kind: ResourceQuota
metadata:
    name: pods-medium
spec:
    hard:
      cpu: "10"
      memory: 20Gi
      pods: "10"
    scopeSelector:
      matchExpressions:
      - operator : In
        scopeName: PriorityClass
        values: ["medium"]
```

### commands

```shell
kubectl create -f compute-quota.yml
```

```shell
kubectl get quota --namespace=myspace
```

## links

- [K8S DNS](https://kubernetes.io/docs/concepts/services-networking/dns-pod-service/)
- [Resource Quotas](https://kubernetes.io/docs/concepts/policy/resource-quotas/)
