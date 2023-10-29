# DaemonSet

A DaemonSet ensures that all (or some) Nodes run a copy of a Pod.
As nodes are added to the cluster, Pods are added to them.
As nodes are removed from the cluster, those Pods are garbage collected. Deleting a DaemonSet will clean up the Pods it created.

Some typical uses of a DaemonSet are:

- running a cluster storage daemon on every node
- running a logs collection daemon on every node
- running a node monitoring daemon on every node

In a simple case, one DaemonSet, covering all nodes, would be used for each type of daemon. A more complex setup might use multiple DaemonSets for a single type of daemon, but with different flags and/or different memory and cpu requests for different hardware types.

## example

```yaml
apiVersion: apps/v1
kind: DaemonSet
metadata:
  name: fluentd-elasticsearch
  namespace: kube-system
  labels:
    k8s-app: fluentd-logging
spec:
  selector:
    matchLabels:
      name: fluentd-elasticsearch
  template:
    metadata:
      labels:
        name: fluentd-elasticsearch
    spec:
      tolerations:
      # these tolerations are to have the daemonset runnable on control plane nodes
      # remove them if your control plane nodes should not run pods
      - key: node-role.kubernetes.io/control-plane
        operator: Exists
        effect: NoSchedule
      - key: node-role.kubernetes.io/master
        operator: Exists
        effect: NoSchedule
      containers:
      - name: fluentd-elasticsearch
        image: quay.io/fluentd_elasticsearch/fluentd:v2.5.2
        resources:
          limits:
            memory: 200Mi
          requests:
            cpu: 100m
            memory: 200Mi
        volumeMounts:
        - name: varlog
          mountPath: /var/log
      terminationGracePeriodSeconds: 30
      volumes:
      - name: varlog
        hostPath:
          path: /var/log
```

## how are they scheduled?

A DaemonSet ensures that all eligible nodes run a copy of a Pod.
The DaemonSet controller creates a Pod for each eligible node and adds the ```spec.affinity.nodeAffinity``` field of the Pod to
match the target host. After the Pod is created, the default scheduler typically takes over and then binds the Pod to
the target host by setting the ```.spec.nodeName field.``` If the new Pod cannot fit on the node, the default scheduler may
preempt (evict) some of the existing Pods based on the priority of the new Pod.

## links

- [K8S DaemonSet](https://kubernetes.io/docs/concepts/workloads/controllers/daemonset/)
- [Static pods](https://kubernetes.io/docs/tasks/configure-pod-container/static-pod/)
