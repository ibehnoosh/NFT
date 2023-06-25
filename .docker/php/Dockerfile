FROM php:8.2-cli-alpine

# Configure file
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

# Install necessary alpine packages
RUN apk update && apk add --no-cache \
    curl \
    zip \
    unzip \
    dos2unix \
    libzip-dev

# Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html