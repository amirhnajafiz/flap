# Service Accounts

Kubernetes offers two distinct ways for clients that run within your cluster,
or that otherwise have a relationship to your cluster's control plane to authenticate to the API server.

A service account provides an identity for processes that run in a Pod, and maps to a ServiceAccount object.
When you authenticate to the API server, you identify yourself as a particular user.
Kubernetes recognises the concept of a user, however, Kubernetes itself does not have a User API.
Pods authenticate as a particular ServiceAccount (for example, default). There is always at least one ServiceAccount in each namespace.

## example

```yaml
apiVersion: v1
kind: Pod
metadata:
  name: my-pod
spec:
  serviceAccountName: build-robot
  automountServiceAccountToken: false
```

```yaml
apiVersion: v1
kind: Pod
metadata:
  name: my-pod
spec:
  serviceAccountName: build-robot
  automountServiceAccountToken: false
```

## links

- [K8S Service Account](https://kubernetes.io/docs/tasks/configure-pod-container/configure-service-account/)
- [K8S Authorization](https://kubernetes.io/docs/reference/access-authn-authz/authorization/)
