FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        curl \
        git \
        zip \
        unzip \
    && mkdir /app \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo pdo_mysql mysqli

COPY ./bin/* /usr/local/bin/
RUN chmod +x /usr/local/bin/*.sh

WORKDIR /app
