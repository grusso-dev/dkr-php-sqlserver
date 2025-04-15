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
│   ├── src                # Your PHP application code
│   ├── nginx
│   │   └── default.conf   # Custom Nginx configuration
│   └── sqlserver
│       └── sql_data       # Persistent database files
└── php
    └── Dockerfile         # Dockerfile for PHP setup
```

---

## 🚀 How to Use

1. **Clone this repository**:

   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   cd your-repo-name
   ```

2. **Start the containers**:

   ```bash
   docker compose up --build -d
   ```

3. **Access the app**: Open your browser and go to [http://localhost:8080](http://localhost:8080)

---

## 🔐 SQL Server Credentials (for development)

- **User**: `sa`
- **Password**: `TuPassword123!`
- **Port**: `1433`

> ⚠️ Make sure to change the password before using this in production.

---

## 🛠 Customize

- Place your PHP code in the `data/src` folder.
- Modify the `php/Dockerfile` to add extensions or change PHP versions.
- Edit `data/nginx/default.conf` for custom Nginx routing or headers.

---

## 🪄 Stop and Clean

To stop the containers:

```bash
docker compose down
```

To remove volumes (including the database data):

```bash
docker compose down -v
```

---

## 📝 License

MIT – Feel free to use, modify, and share.
