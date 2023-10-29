# Cluster Upgrade

For upgrading your cluster, node need to first upgrade your master node.
This may cause a downtime for cluster controller manager and scheduler, but
the worker nodes remain up.

After upgrading the master node, you need to drain each worker node, upgrade
it's system and recordon it. If you are using a cloud based environment, you can
add new version nodes and drain and remove old ones.
