# Service Mesh

The use of Kubernetes to run workloads has become the standard in most organizations.
While this has many advantages, it also introduces some challenges.
One of the challenges is managing communication between services.
Because Kubernetes abstracts away the visibility of the communication.
This makes it difficult to troubleshoot problems and ensure that services are communicating.

Service mesh technologies offer a robust and effective solution to address that challenge.
By adopting a sidecar approach, Service Mesh provides a centralized way of managing communication.
This approach brings a wide range of features such as load balancing and observability to name a few.
Two of the leading Service Mesh for Kubernetes are Istio and Linkerd.
Both are graduate projects in the Cloud Native Computing Foundation (CNCF).

Other Open source Service mesh tools:

- Consul
- Open service mesh
- Network service mesh

These platforms offer a variety of features.
They can help improve the reliability, performance, and security of microservices-based applications.

![](https://miro.medium.com/v2/resize:fit:1260/format:webp/1*dE01Th9iyq3VQUni9bC2_A.png)

## Control Plane

The Istio control plane consists of the following components:

- Pilot: The Pilot component handles routing traffic between services.
- Galley: The Galley component handles storing and managing configuration data.
- Citadel: The Citadel component handles issuing and managing TLS certificates.
- Istiod: The Istiod component is the central control plane component in Istio. It provides a single point of contact for all other components in the control plane. It also provides a REST API for managing the service mesh.

## links

- [Medium Blog](https://medium.com/@onai.rotich/istio-vs-linkerd-service-mesh-showdown-2023-370937107452)
