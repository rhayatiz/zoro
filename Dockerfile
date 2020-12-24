FROM php:7.2-fpm-alpine

# Install php extensions
RUN docker-php-ext-install pdo pdo_mysql