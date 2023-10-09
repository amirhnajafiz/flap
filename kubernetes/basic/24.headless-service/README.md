# Headless service

A headless Service is a type of Kubernetes Service that does not allocate a cluster IP address.
Instead, a headless Service uses DNS to expose the IP addresses of the Pods that are associated with the Service.
This allows you to connect directly to the Pods, instead of going through a proxy.

A headless service in Kubernetes can be a useful tool for creating distributed applications.
It allows you to directly access the individual pods in a service.
This is useful in scenarios where you need to perform complex load-balancing.

Headless Services (without a cluster IP) Services are also assigned DNS A and/or AAAA records, with a name of the form my-svc.my-namespace.svc.cluster-domain.example.
Unlike normal Services, this resolves to the set of IPs of all of the Pods selected by the Service.
