# Kubernetes

Learn ```Kubernetes``` from basic to high level. In this directory I gathered my notes about
kubernetes commands and features. These notes are useful for developers who just want to use
kubernetes cluster in order to deploy their applications.

## Kubectl commands

### get cluster info

```kubectl cluster-info```

### get cluster nodes

```kubectl get nodes```

### create single pod

```kubectl run nginx --image nginx```

### get list of pods

```kubectl get pods```

### deploy a single pod

```kubectl create -f pod-definition.yml```

Check the [definition file](pod-definition.yml).

### get a pod status (inspect pod)

```kubectl describe pod pod-name```
