# dkr-php-sqlserver
Este proyecto consiste en crear un docker compose que me permita instalar un apache con php y conectar con una base de datos Sql Server en un entorno linux

### PHP application with Apache2

Project structure:
```
.
├── compose.yaml
└──php
    ├── Dockerfile
    └── src
         └── index.php

```

[_compose.yaml_](compose.yaml)
```
version: '3.1'

services:
  sqlserver:
    image: mcr.microsoft.com/mssql/server:2019-CU3-ubuntu-18.04
    container_name: sqlserver2019
    ports:
      - 1433:1433
    environment:
      ACCEPT_EULA: Y
      SA_PASSWORD: Password01
      SSQL_PID: Express
    volumes:
      - ./sqlserver-data:/var/opt/mssql
  php:
    build: ./php
    ports:
      - 80:80
    volumes:
      - ./php/src:/var/www/html
```

## Deploy with docker compose

```
$ docker compose up -d
Creating network "php-docker_web" with the default driver
Building web
Step 1/6 : FROM php:7.2-apache
...
...
Creating php-docker_web_1 ... done

```

## Expected result

Listing containers must show one container running and the port mapping as below:
```
$ docker ps
CONTAINER ID        IMAGE                        COMMAND                  CREATED             STATUS              PORTS                  NAMES
2bc8271fee81        php-docker_web               "docker-php-entrypoi…"   About a minute ago  Up About a minute   0.0.0.0:80->80/tc    php-docker_web_1
```

After the application starts, navigate to `http://localhost:80` in your web browser or run:
```
$ curl localhost:80
Hello World!
```

Stop and remove the containers
```
$ docker compose down
```
