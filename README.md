# dkr-php-sqlserver
Este proyecto consiste en crear un docker compose que me permita instalar un apache con php y conectar con una base de datos Sql Server en un entorno linux

### PHP application with Apache2

Project structure:
```
.
├── compose.yaml
├── data
|    └─ nginx
|    |    └── default.conf
|    ├── php
|    ├── sqlserver
|    |      └── sql_data 👉 #Recordar derle permisos de lectura y escritura (chmod -R 777 sql_data)
|    └── src
|         └── index.php
└──php
    └── Dockerfile

```

[_compose.yaml_](compose.yaml)
```
#version: '3.8'
services:
  php:
    build:
      context: ./php
      dockerfile: Dockerfile
    container_name: php_app
    volumes:
      - ../data/src:/var/www
    expose:
      - 9000
    depends_on:
      - sqlserver
    networks:
      - app-network

  nginx:
    image: nginx:alpine
    container_name: nginx_web
    ports:
      - "8080:80"
    volumes:
      - ../data/src:/var/www
      - ./data/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - php
    networks:
      - app-network

  sqlserver:
    image: mcr.microsoft.com/mssql/server:2019-latest
    container_name: sql_server
    environment:
      SA_PASSWORD: "TuPassword123!"
      ACCEPT_EULA: "Y"
    volumes:
      - ./data/sqlserver/sql_data:/var/opt/mssql
    ports:
      - "1433:1433"
    networks:
      - app-network

networks:
  app-network:
    driver: bridge
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

After the application starts, navigate to `http://localhost:8080` in your web browser or run:
```
$ curl localhost:80
Hello World!
```

Stop and remove the containers
```
$ docker compose down
```
