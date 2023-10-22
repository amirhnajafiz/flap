# Service

In Kubernetes, a Service is a method for exposing a network application that is running as one or more Pods in your cluster.
The Service API, part of Kubernetes, is an abstraction to help you expose groups of Pods over a network.
Each Service object defines a logical set of endpoints (usually these endpoints are Pods) along with a policy about how to
make those pods accessible.

## example

```yaml
apiVersion: v1
kind: Service
metadata:
  name: my-service
spec:
  selector:
    app.kubernetes.io/name: MyApp
  ports:
    - protocol: TCP
      port: 80
      targetPort: 9376
```

## service without selectors

Services most commonly abstract access to Kubernetes Pods thanks to the selector, but when used with a corresponding set of
EndpointSlices objects and without a selector, the Service can abstract other kinds of backends,
including ones that run outside the cluster.


## service type

### ClusterIP

Exposes the Service on a cluster-internal IP. Choosing this value makes the Service only reachable from within the cluster. This is the default that is used if you don't explicitly specify a type for a Service. You can expose the Service to the public internet using an Ingress or a Gateway.

### NodePort

Exposes the Service on each Node's IP at a static port (the NodePort). To make the node port available, Kubernetes sets up a cluster IP address, the same as if you had requested a Service of type: ClusterIP.

### LoadBalancer
Exposes the Service externally using an external load balancer. Kubernetes does not directly offer a load balancing component; you must provide one, or you can integrate your Kubernetes cluster with a cloud provider.

### ExternalName
Maps the Service to the contents of the externalName field (for example, to the hostname api.foo.bar.example). The mapping configures your cluster's DNS server to return a CNAME record with that external hostname value. No proxying of any kind is set up.

## links

- [K8S service](https://kubernetes.io/docs/concepts/services-networking/service/)
