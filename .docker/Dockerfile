FROM php:8.1.0RC5-apache-buster
USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    zip \
    sudo \
    curl \
    nano \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install exif \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-enable exif \
    && docker-php-source delete

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

EXPOSE 80