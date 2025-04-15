#!/bin/bash

# Nombre del contenedor SQL Server
CONTAINER_NAME=sql_server

# Nombre de la base de datos a respaldar
DATABASE_NAME=MyDatabase

# Nombre del archivo de backup
BACKUP_NAME=${DATABASE_NAME}_$(date +%Y%m%d_%H%M%S).bak

# Ruta dentro del contenedor donde se guardará el backup
CONTAINER_BACKUP_PATH=/var/opt/mssql/backups

# Crear el directorio si no existe
docker exec $CONTAINER_NAME mkdir -p $CONTAINER_BACKUP_PATH

# Ejecutar el backup
docker exec $CONTAINER_NAME /opt/mssql-tools/bin/sqlcmd \
   -S localhost -U sa -P 'TuPassword123!' \
   -Q "BACKUP DATABASE [$DATABASE_NAME] TO DISK = N'$CONTAINER_BACKUP_PATH/$BACKUP_NAME' WITH NOFORMAT, NOINIT, NAME = '$DATABASE_NAME-full', SKIP, NOREWIND, NOUNLOAD, STATS = 10"

# Copiar el backup al host
docker cp $CONTAINER_NAME:$CONTAINER_BACKUP_PATH/$BACKUP_NAME ./data/sqlserver/backups/$BACKUP_NAME

echo "✅ Backup completed: ./data/sqlserver/backups/$BACKUP_NAME"
