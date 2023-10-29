# Endpoint & EndpointSlices

In the Kubernetes API, an Endpoints (the resource kind is plural) defines a list of network endpoints, typically referenced by a Service to define which Pods the traffic can be sent to.
The EndpointSlice API is the recommended replacement for Endpoints.

Kubernetes' EndpointSlice API provides a way to track network endpoints within a Kubernetes cluster. EndpointSlices offer a more scalable and extensible alternative to Endpoints.
An EndpointSlice contains references to a set of network endpoints.
The control plane automatically creates EndpointSlices for any Kubernetes Service that has a selector specified.
These EndpointSlices include references to all the Pods that match the Service selector.
EndpointSlices group network endpoints together by unique combinations of protocol, port number, and Service name. The name of a
EndpointSlice object must be a valid DNS subdomain name.

## example

```yaml
apiVersion: discovery.k8s.io/v1
kind: EndpointSlice
metadata:
  name: example-abc
  labels:
    kubernetes.io/service-name: example
addressType: IPv4
ports:
  - name: http
    protocol: TCP
    port: 80
endpoints:
  - addresses:
      - "10.1.2.3"
    conditions:
      ready: true
    hostname: pod-1
    nodeName: node-1
    zone: us-west2-a
```
