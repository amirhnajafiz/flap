# ETCD

Distributed reliable key-value store that is simple, secure, and fast. It's used
for fast read and write.

## run etcd

Starts on ```2379```. By using ```etcd``` and ```etcdctl```.

### commands

```shell
./etcdctl set key1 value1
./etcdctl get key1
```

## in kubernetes

Stores cluster information like Nodes, Pods, Configs, Secrets, Accounts, Roles,
Bindings, etc. Every change to cluster will get updated here. Complete changes are stored in this storage.

## deployment

Content of ```etcd.service```.

```shell
--advertise-client-urls https://${INTERNAL_IP}:2379 \\
--initial-cluster controller-0=https://${CONTROLLER0_IP}:2380,controller-1=https://${CONTROLLER1_IP}:2380 \\
```
