# Laravel Micro-services Example #

This is a simple laravel micro-services example project.
It is to show how to create a separation and integration of micro-services in an application, with a containerised 
local environment using docker with a reverse proxy sitting on top. Could be a starting point for a full-fledged microservices application!

## How to get set up ##

This project consists of three micro-services `user`, `product` & `order` and `api-gateway`(an API gateway). 
The micro-services are containerised using Docker and are accessible within a [Traefik](https://traefik.io) proxy interface.

Using `traefik` image for the proxy container and php:8.0.0-apache image, which is extended for the micro-services containers & the API gateway.

The api is using the [Guzzle](https://docs.guzzlephp.org) API Client in order to maintain connection with the micro-services.
[Lumen](https://lumen.laravel.com) was used as it is the perfect solution for building Laravel based micro-services and blazing fast APIs.

## Configuration ##
Install Docker & Docker Machine
------------------
If you don't have Docker installed, you can download it [here](https://docs.docker.com/engine/install).
And [Docker Machine](https://docs.docker.com/machine/install-machine).
Create a docker-machine *
---------------
```
    docker-machine create laravel-microservices-example
    eval $(docker-machine env laravel-microservices-example)
```
Mount volumes as NFS
-----------------
To prevent permission problems, leverage Docker-Machine-NFS to mount volumes as NFS.
First, [install docker-machine-nfs](https://github.com/adlogix/docker-machine-nfs) and then run the following command:
```bash
docker-machine-nfs laravel-microservices-example --nfs-config="-alldirs -maproot=0" --mount-opts="noacl,async,nolock,vers=3,udp,noatime,actimeo=1"
```
Create the external network
------------------
```
    docker network create web
```
Update your hosts file
-------------------
```
    # Get the ip of the VMachine
    docker-machine ip laravel-microservices-example
    
    # Update /etc/hosts file
    192.168.99.103 laravel-microservice-example.local user.laravel-microservice-example.local inventory.laravel-microservice-example.local order.laravel-microservice-example.local api.laravel-microservice-example.local
```
Setup all micro-services
------------
In order to get up and running, you need to setup each
individual service.

- [frontend](frontend/readme.md)
- [api gateway](api-gateway/readme.md)
- [order](order/readme.md)
- [product](product/readme.md)
- [user](user/readme.md)

Once you set all services, you are ready to use them.

## Deployment instructions ##
Build & Run
------------
```
    docker-compose -f docker/docker-compose.yml up -d --build
```

Access
------------
The endpoints to access each micro-service are:
```
    #frontend
    http://laravel-microservice-example.local
    
    #api gateway
    http://api-gateway.laravel-microservice-example.local
    
    #order
    http://order.laravel-microservice-example.local
    
    #product
    http://product.laravel-microservice-example.local

    #user
    http://user.laravel-microservice-example.local
```

#### Reverse proxies
You can access Traefik interface from:
```
    http://laravel-microservice-example.local:8080
```

Teardown and "Scale"
------------
#### Teardown
```
    docker-compose -f docker/docker-compose.yml down --volumes --remove-orphans
```
Isolate Micro-Services
------------
Setting the `traefik.enable=false` for the micro-services will make them accessible only from the API gateway (proxy backend network).

## Improvements & Considerations ##
* Database configuration - Use databases to store data. You can add new docker `mysql` containers in `docker/docker-compose.yml` and apply 
proxy configuration in order to be able to access them.
* Each service must be accessible from a unique entry point, in our case the APIs.
This should be the only way for communication between services.
* Communication between the services should not be direct. One service should not be aware of the other!
This type of communication can be achieved by using messaging or events.
* Tests are essential part of software development. Functionality of each service should be
unit tested. Functionality of the whole flow should be functionally tested.

## Contribution guidelines ##

* Since this is a PHP project, PHPUnit will be used for unit tests.
* Contributions are welcomed, so a code review is done when a pull request is created and merged appropriately if changes are fine.

## Contact ##

* Michael (michael@apexcreation.co.uk)