# Taints and Tolerations

Node affinity is a property of Pods that attracts them to a set of nodes
(either as a preference or a hard requirement).
Taints are the opposite -- they allow a node to repel a set of pods.

Tolerations are applied to pods.
Tolerations allow the scheduler to schedule pods with matching taints.
Tolerations allow scheduling but don't guarantee scheduling;
the scheduler also evaluates other parameters as part of its function.

Taints and tolerations work together to ensure that
pods are not scheduled onto inappropriate nodes. One or more taints are applied to a node;
this marks that the node should not accept any pods that do not tolerate the taints.

## example

```shell
kubectl taint nodes node1 key1=value1:NoSchedule
```

```yaml
apiVersion: v1
kind: Pod
metadata:
  name: nginx
  labels:
    env: test
spec:
  containers:
    - name: nginx
      image: nginx
      imagePullPolicy: IfNotPresent
  tolerations:
    - key: "example-key"
      operator: "Exists"
      effect: "NoSchedule"
```
