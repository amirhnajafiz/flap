# Ingress

Ingress exposes HTTP and HTTPS routes from outside the cluster to services within the cluster.
Traffic routing is controlled by rules defined on the Ingress resource.

![](https://kubernetes.io/docs/images/ingress.svg)

An Ingress may be configured to give Services externally-reachable URLs, load balance traffic, terminate SSL / TLS,
and offer name-based virtual hosting.
An Ingress controller is responsible for fulfilling the Ingress, usually with a load balancer, though it may also configure your edge router or additional frontends to help handle the traffic.

## example

```yaml
apiVersion: networking.k8s.io/v1
kind: Ingress
metadata:
  name: minimal-ingress
  annotations:
    nginx.ingress.kubernetes.io/rewrite-target: /
spec:
  ingressClassName: nginx-example
  rules:
  - http:
      paths:
      - path: /testpath
        pathType: Prefix
        backend:
          service:
            name: test
            port:
              number: 80
```

## ingress controller

In order for the Ingress resource to work, the cluster must have an ingress controller running.
Unlike other types of controllers which run as part of the kube-controller-manager binary,
Ingress controllers are not started automatically with a cluster.

## links

- [K8S Ingress](https://kubernetes.io/docs/concepts/services-networking/ingress/)
- [Ingress Controller](https://kubernetes.io/docs/concepts/services-networking/ingress-controllers/)
