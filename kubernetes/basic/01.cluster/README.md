# Cluster

Kubernetes can get installed on various methods. Kubernetes runs your workload by placing containers into Pods to run on Nodes.
A node may be a virtual or physical machine, depending on the cluster.
Each node is managed by the control plane and contains the services necessary to run Pods.
The components on a node include the kubelet, a container runtime, and the kube-proxy.

## install

To install a single node kubernetes cluster on your system you can use the following tools.

### minikube

```minikube``` is local Kubernetes, focusing on making it easy to learn and develop for Kubernetes.

- [minikube.install.io](https://minikube.sigs.k8s.io/docs/start/)

### kind

```kind``` is a tool for running local Kubernetes clusters using Docker container ```nodes```.
```kind``` was primarily designed for testing Kubernetes itself, but may be used for local development or CI.

- [kind.sigs.k8s.io](https://kind.sigs.k8s.io/)

### k3s

```k3s``` is a highly available, certified Kubernetes distribution designed for production workloads in unattended, 
resource-constrained, remote locations or inside IoT appliances.

- [k3s.io](https://k3s.io/)

## context

Kubernetes clusters information are located in ```~/.kube/config``` file. The file is like this:

```yaml
apiVersion: v1

clusters:
- cluster:
    server: https://napi.arvancloud.ir/caas/v2/zones/ir-thr-ba1
  name: ir-thr-ba2
contexts:
- context:
    cluster: ir-thr-ba2
    namespace: amirhnajafiz
    user: 70846d2b
  name: ir-thr-ba2

current-context: ir-thr-ba2

kind: Config
preferences: {}
users:
- name: 70846d2b
  user:
    token: 7d56b4b0
```

A Kubernetes context is a group of access parameters that define which cluster you're interacting with,
which user you're using, and which namespace you're working in.

### commands

change context:

```sh
kubectl config use-context ir-thr-ba2
```

view configs:

```sh
kubectl config view
```

## links

- [K8S configure access](https://kubernetes.io/docs/tasks/access-application-cluster/configure-access-multiple-clusters/)
