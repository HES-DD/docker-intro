# docker-intro


## What is docker?

docker.com says: (https://docs.docker.com/get-started/overview/)
> Docker is an open platform for developing, shipping, and running applications. Docker enables you to separate your applications from your infrastructure so you can deliver software quickly. With Docker, you can manage your infrastructure in the same ways you manage your applications. By taking advantage of Docker's methodologies for shipping, testing, and deploying code, you can significantly reduce the delay between writing code and running it in production.

and 

> Docker provides the ability to package and run an application in a loosely isolated environment called a container. The isolation and security lets you to run many containers simultaneously on a given host. Containers are lightweight and contain everything needed to run the application, so you don't need to rely on what's installed on the host. You can share containers while you work, and be sure that everyone you share with gets the same container that works in the same way.


## Install docker

- https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository
- https://docs.docker.com/engine/install/linux-postinstall/

or Docker Desktop


## 1 - Our first container

- go into /1_first-container
- run `docker build -t my-apache2 .`
- run `docker run -dti --name my-running-app -p 8080:80 my-apache2`
- http://localhost:8080/
---
- run `docker ps` to see the running container (`-a` to see also stopped containers)
- run `docker stop my-running-app` to stop the container


 ## 2 - running commands and a custom CMD

- go into /2_custom-cmd
- run `docker build -t node-hello .`
- run `docker run -ti -p 5000:5000 node-hello`


## 3 - Exercise 1

Create a docker container running a ubuntu 
with the cowsay command installed (it's on apt).
Let the cow say "Hello World" when the container is started.

### Tipps:
- you can find ubuntu on docker hub
- you can install cowsay with `apt update && apt install cowsay -y`
- you can run cowsay with `/usr/games/cowsay 'Hello World'`


### Solution
- go into /3_exercise-1
- run `docker build -t cow .`
- run `docker run -ti cow`


## 4 - Volumes
- go into /4_volumes
- run `docker build -t node-volumes .`
- run `docker run -ti -p 5000:5000 -v ./data:/data node-volumes`

## 5 - Composing
- go into /5_composing
- run `docker-compose up`

## 6 - image tool
- show code

## 7 - Exercise 2

Build a docker compose environment with 2 containers. 
One shows a static JSON `{"message": "Hello World"}` on port 5000.
The other calls this service and prints the message to the console.
Use any tech stacks you want.

### Tipps
- you could use node.js or httpd for the first container
- you could use curl, node.js or php for the second container
