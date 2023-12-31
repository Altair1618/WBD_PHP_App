FROM php:8.0-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y

RUN apt-get install -y libpq-dev libxml2-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql soap
COPY php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite

EXPOSE 80
