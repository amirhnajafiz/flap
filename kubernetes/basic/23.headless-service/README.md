# Headless service

A headless Service is a type of Kubernetes Service that does not allocate a cluster IP address.
Instead, a headless Service uses DNS to expose the IP addresses of the Pods that are associated with the Service.
This allows you to connect directly to the Pods, instead of going through a proxy.

Headless service is a regular Kubernetes service where the spec. clusterIP is explicitly set to "None" and spec. type is set to "ClusterIP". Instead, SRV records are created for all the named ports of service's endpoints.

A headless service in Kubernetes can be a useful tool for creating distributed applications.
It allows you to directly access the individual pods in a service.
This is useful in scenarios where you need to perform complex load-balancing.

Headless Services (without a cluster IP) Services are also assigned DNS A and/or AAAA records, with a name of the form my-svc.my-namespace.svc.cluster-domain.example.
Unlike normal Services, this resolves to the set of IPs of all of the Pods selected by the Service.

## challanges

Deploying and replicating stateful applications poses the following challenges:

- Pod replicas cannot be created or deleted at the same time. StatefulSet will not create the next pod until the previous pod is up and running.
- Pods are not interchangable. Pod replicas have a persistent identifier across any rescheduling.
- Continous data synchronization between pods is necessary to maintain same states.
- If all pods die or the clusters running these pods crash, data will be lost. Each pod should have its own persistent storage with replicable data and pod state, stored in the pod's own storage, so that when a pod dies, the Persistent Pod Identifiers will reattach the volume to the replaced pod. Reattaching persistent volumes requires remote storage.
- StatefulSet pods get fixed ordered names ($statefulsetname-$ordinal). For example, if you create a StatefulSet with a name of mongo with three replicas, the replicated pods get names mongo-0, mongo-1, and mongo-2.
- Most importantly, the stateful workloads often has to reach a specific pod directly (for example, during database write operations) or have pod-pod communication, without load balancing.

## example

```yaml
apiVersion: v1 
kind: Service 
metadata: 
    name: foo 
spec: 
   clusterIP: None 
   selector: 
        key1: val1 
        key2: val2 
   ports: 
     - port: 8080 
       protocol: TCP
   type: ClusterIP
```

## links

- [VMware Tanzu](https://docs.vmware.com/en/VMware-Tanzu-Service-Mesh/services/using-tanzu-service-mesh-guide/GUID-38865240-F238-4699-AE75-171EC494F192.html#:~:text=Headless%20service%20is%20a%20regular,named%20ports%20of%20service's%20endpoints.)
- [Middleware inventory](https://www.middlewareinventory.com/blog/kubernetes-headless-service/)
- [Why stateful apps need headless service?](https://chamszamouri.medium.com/why-stateful-applications-in-k8s-need-a-headless-service-20d3db993872)
