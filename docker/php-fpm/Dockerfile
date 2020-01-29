FROM php:7.2-fpm

WORKDIR "/var/www/html"

ARG DEBIAN_FRONTEND=noninteractive

ADD ./php.ini /usr/local/etc/php/php.ini
ADD ./www.conf /usr/local/etc/php-fpm.d/www.conf

RUN apt-get update && apt-get install -y \
        curl \
        cron \
        libzip-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
            --no-install-recommends

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql zip exif sockets bcmath pcntl gd

