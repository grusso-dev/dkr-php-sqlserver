# 🚀 Docker Compose for PHP, Nginx, and SQL Server

This project provides a simple and ready-to-use Docker Compose setup to run a development environment with **PHP**, **Nginx**, and **Microsoft SQL Server**.

It's ideal for developers who want to build or test PHP applications with a SQL Server backend in a containerized environment.

---

## 📦 Stack Overview

- **PHP** – Built from a custom Dockerfile, runs the PHP application code.
- **Nginx** – Lightweight web server to serve your PHP app.
- **SQL Server 2019** – Official Microsoft image for development and testing.

---

## 📁 Folder Structure
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
$ curl localhost:8080
Hello World!
```

Stop and remove the containers
```
$ docker compose down
```
