# Secrets

A Secret is an object that contains a small amount of sensitive data such as a password, a token, or a key.
Such information might otherwise be put in a Pod specification or in a container image.
Using a Secret means that you don't need to include confidential data in your application code.

Because Secrets can be created independently of the Pods that use them, there is less risk of the Secret
(and its data) being exposed during the workflow of creating, viewing, and editing Pods. Kubernetes, and applications
that run in your cluster, can also take additional precautions with Secrets, such as avoiding writing sensitive data to nonvolatile storage.

Secrets are similar to ConfigMaps but are specifically intended to hold confidential data.

Kubernetes Secrets are, by default, stored unencrypted in the API server's underlying data store (etcd).
Anyone with API access can retrieve or modify a Secret, and so can anyone with access to etcd. Additionally,
anyone who is authorized to create a Pod in a namespace can use that access to read any Secret in that namespace;
this includes indirect access such as the ability to create a Deployment.

In order to safely use Secrets, take at least the following steps:

- Enable Encryption at Rest for Secrets.
- Enable or configure RBAC rules with least-privilege access to Secrets.
- Restrict Secret access to specific containers.
- Consider using external Secret store providers.

## example

```yaml
apiVersion: v1
kind: Secret
metadata:
  name: dotfile-secret
data:
  .secret-file: dmFsdWUtMg0KDQo=
---
apiVersion: v1
kind: Pod
metadata:
  name: secret-dotfiles-pod
spec:
  volumes:
    - name: secret-volume
      secret:
        secretName: dotfile-secret
  containers:
    - name: dotfile-test-container
      image: registry.k8s.io/busybox
      command:
        - ls
        - "-l"
        - "/etc/secret-volume"
      volumeMounts:
        - name: secret-volume
          readOnly: true
          mountPath: "/etc/secret-volume"
```

## commands

```sh
kubectl create secret generic empty-secret
kubectl get secret empty-secret
```

## links

- [K8S Secrets](https://kubernetes.io/docs/concepts/configuration/secret/#serviceaccount-token-secrets)
