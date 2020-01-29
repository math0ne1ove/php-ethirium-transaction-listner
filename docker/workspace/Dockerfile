FROM php:7.2-cli-stretch

WORKDIR "/var/www/html/workspace"

RUN apt-get update && apt-get install -y \
        curl \
        cron \
        unzip \
        git \
        libzip-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libmagickwand-dev \
        htop \
        wget \
        vim \
        procps \
        libssl-dev \
        openssl \
            --no-install-recommends \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN pecl install imagick \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql zip exif sockets bcmath pcntl gd \
    && docker-php-ext-enable imagick

RUN echo "* * * * * cd /var/www/html/workspace && php artisan schedule:run >> /dev/null 2>&1" >> "/etc/crontab" \
    && crontab -u root '/etc/crontab'

CMD /etc/init.d/cron start && php -a
