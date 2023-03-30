# Practice 01

## Nginx pod

```shell
kubectl run nginx-pod --image=nginx:alpine
```

## Redis pod

```shell
kubectl run redis image=redis:alpine --labels=tier=db
```

## Redis service

```shell
kubectl expose pod redis --name redis-service --port 6379 --target-port 6379
```

## Webapp deployment

```shell
kubectl create deployment webapp --image==kodekloud/webapp-color
kubectl scale deploymet --replicas=3 webapp
```

## Nginx expose

```shell
kubectl run custom-nginx --image=nginx --port 8080
```

## Create namespace

```shell
kubectl create namespace dev-ns
```

## Redis deployment on dev-ns

```shell
kubectl create deployment redis-deploy --image=redis --namespace=dev-ns
kubectl scale deployment --replicas=2 redis-deploy --namespace=dev-ns
```

## HTTPD service

```shell
kubectl run httpd --image=httpd:alpine --port 80 --expose
```
