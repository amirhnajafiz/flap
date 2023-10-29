# Nodes Upgrade

Can cause problems when replicas are running on different nodes. If nodes go down or
get terminated, other replicas will be replaced on other nodes.
Offline nodes are waited 5 minutes to get back online.
For maintanace node, check node replicas and pods on it.

Best solution is to drain a node. All pods on a drained node will be moved to other
nodes. A drained node is unschedulable, meaning that no new pods will be created on it.
Once you wanted to bring your node back, you need to uncordon it.

## commands

```sh
kubectl drain node-1
```

```sh
kubectl uncordon node-1
```

By doing cordon, pods will not move to other nodes, but the node will be unschedulable.

```sh
kubectl cordon node-1
```
