# Kubernetes

Kubernetes automates operational tasks of container management and includes built-in commands for deploying applications,
rolling out changes to your applications, scaling your applications up and down to fit changing needs,
monitoring your applications, and more—making it easier to manage applications. Kubernetes is written in ```Go```.

The most useful feature of Kubernetes is that it can deploy your applications on more than one physical node.
It has an scheduler that manages your deployments on nodes.

Where you run Kubernetes is up to you. This can be on bare metal servers, virtual machines (VMs),
public cloud providers, private clouds, and hybrid cloud environments.
One of Kubernetes’ key advantages is it works on many different kinds of infrastructure.

Kubernetes has a master node which main components are running in that node. Other nodes
are compute nodes or worker nodes that communicate with master node by using ```kubelet```.

Kubernetes main components are listed bellow:

- Kube API server (master) : connects all of the components together
- Kube Scheduler (master) : setups pods on nodes
- Kube Controller-manager (master) : contains all controllers that perform system logic
- ETCD (master) : a key-value database
- Kubelet (worker) : manages pods on each node
- Kube-proxy (worker) : is used to manage each node's network interface
- Container runtime (worker) : docker, rkt, podman, ...
- Persistent storage : a long-term memory
- Container registery : stores and lets you distribute container images

![Kubernetes Schema](https://www.redhat.com/rhdc/managed-files/kubernetes_diagram-v3-770x717_0_0_v2_0.svg)
