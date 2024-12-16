# Usar la imagen base de PHP
FROM php:8.1-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar el código de la aplicación
COPY . /var/www/html/

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html
