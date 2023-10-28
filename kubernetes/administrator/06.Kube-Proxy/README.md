# Kube Proxy

Every pod can access another pod by using an internal virtual network.
Traffic will be forwarded to backend application.
Service is not an actual thing. It is virtual and lives in cluster memory.
Kube Proxy is a process on each node and it's job is to look for new services
and creates rules to forward traffic. By using ip tables rule in each node's cluster.
