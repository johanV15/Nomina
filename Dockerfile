FROM php:7.4-apache

# Instala las extensiones necesarias
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY /src /var/www/html

EXPOSE 80
