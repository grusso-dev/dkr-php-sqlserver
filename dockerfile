FROM php:7.4.1-apache-buster
COPY ./src/ /var/www/html

RUN apt-get update && apt-get install -y gnupg2
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17 unixodbc-dev

RUN pecl install sqlsrv pdo_sqlsrv
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv
EXPOSE 80