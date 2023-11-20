
<style>section { font-size: 20px; }</style>

<style scoped>section { margin: auto; text-align: center; }</style>

# docker introduction

![](https://upload.wikimedia.org/wikipedia/commons/4/4e/Docker_%28container_engine%29_logo.svg)

because containers are ~~f*ing~~ really useful ❤️

---

## What is docker?

docker.com says: (https://docs.docker.com/get-started/overview/)
> Docker is an open platform for developing, shipping, and running applications. Docker enables you to separate your applications from your infrastructure so you can deliver software quickly. With Docker, you can manage your infrastructure in the same ways you manage your applications. By taking advantage of Docker's methodologies for shipping, testing, and deploying code, you can significantly reduce the delay between writing code and running it in production.

and 

> Docker provides the ability to package and run an application in a loosely isolated environment called a container. The isolation and security lets you to run many containers simultaneously on a given host. Containers are lightweight and contain everything needed to run the application, so you don't need to rely on what's installed on the host. You can share containers while you work, and be sure that everyone you share with gets the same container that works in the same way.

---

### talking points:
- a container is like a virtual machine, but it's not
- can be controlled over the command line or docker desktop
- docker images are build from a Dockerfile or can be downloaded from the docker hub
- when run `docker run hello-world` you are running the image `hello-world` in a container

![](https://miro.medium.com/v2/resize:fit:1400/format:webp/0*CP98BIIBgMG2K3u5.png)

---

## Install docker

- https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository
- https://docs.docker.com/engine/install/linux-postinstall/

or Docker Desktop

Make sure you can run it with `docker run hello-world`.
(If you get an error, perhaps your user is not in the docker group!)

---

## 1 - Our first container

- go into /1_first-container
- run `docker build -t my-apache2 .`
- run `docker run -dti --name my-running-app -p 8080:80 my-apache2`
- http://localhost:8080/
- run `docker ps` to see the running container (`-a` to see also stopped containers)
- run `docker stop my-running-app` to stop the container

### talking points:
- Dockerfiles always start with `FROM`. They are based on another image.
- You can create/configure/install your "server" inside your Dockerfile with COPY / RUN etc.
- `docker build` builds an image from a Dockerfile
- `docker run` runs a container from an image
- if you have the `-d` flag, the container runs in the background. `-ti` is for interactive mode
- `docker ps -a` shows all containers
- sometimes containers can't be stopped with CTRL+C, then use `docker stop <container-name>`
- you can expose ports with `-p <host-port>:<container-port>`
- if you don't give your container a name, docker will automaticly create one

---

## 2 - running commands and a custom CMD

- go into /2_custom-cmd
- run `docker build -t node-hello .`
- run `docker run -ti -p 5000:5000 node-hello`

### talking points:
- a prebuild image already has an application/binary which is running by CMD as a main process
- you can define your own CMD in the end of your Dockerfile 

---

## 3 - Exercise 1

Create a docker container running ubuntu 
with the cowsay command installed (it's on apt).
Let the cow say "Hello World" when the container is started.

### Tipps:
- you can find ubuntu on docker hub
- you can install cowsay with `apt update && apt install cowsay -y`
- you can run cowsay with `/usr/games/cowsay 'Hello World'`

---

## 4 - Volumes
- go into /4_volumes
- run `docker build -t node-volumes .`
- run `docker run -ti -p 5000:5000 -v ./data:/data node-volumes`

### talking points:
- containers are ephemeral, they don't save data
- if you need persistent data you have to use volumes
- you can mount volumes with `-v <host-path>:<container-path>`
- volumes are *not* available at build time (image), only at run time (container)
- Source code should be copied not mounted (except for development)

---

## 5 - Composing
- go into /5_composing
- run `docker-compose up`

### talking points:
- docker-compose is a tool to run multiple containers
- you can define your containers in a docker-compose.yml file
- you can start them with `docker compose up` (`-d` for background)
- you can stop them with `docker compose down`
- `--build` to rebuild the images

---

## 6 - image tool
see imagetool code

### talking points:
- image tool has two sets of compose files (dev and prod)
- in dev the source code is mounted, in prod it's copied and build 
- the prod Dockerfiles have several layers to keep the final image small

---

## 7 - Exercise 2

Build a docker compose environment with 2 containers. 
One shows a static JSON `{"message": "Hello World"}` on port 5000.
The other calls this service and prints the message to the console.
Use any tech stacks you want.

### Tipps
- you could use for example node.js or httpd for the first container
- you could use for example curl, node.js or php for the second container

---

# Done!
- What if we need many containers?
- What if we need to scale them depending on traffic/load?
- What if we need to update them without downtime?
--> Kubernetes to the rescue! 🤯

