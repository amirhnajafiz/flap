# Example
`
In this example we are going to deploy a full app (```front-end``` and ```back-end```) on ```kubernetes```.
In order to do this, first connect to a ```kuber``` cluster (you can use ```minikube```, ```kind```, or ```k3s```).
After that you can deploy this app using the following ```kubernetes``` manifests.

## Docker Image

Front-end application docker image:

### ```amd64```

```sh
docker pull amirhossein21/sample-nginx:v0.1.5
```

### ```arm64```

```sh
docker pull amirhossein21/sample-nginx:v0.1.6
```

Back-end application docker image:

### ```amd64```

```sh
docker pull amirhossein21/sample-http:v0.1.2
```

### ```arm64```

```sh
docker pull amirhossein21/sample-http:v0.1.3
```

## Configmap

## Deployment

## Service
