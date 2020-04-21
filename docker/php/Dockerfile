FROM php:7.4-fpm-buster

ADD . /var/www/app

RUN docker-php-ext-install pdo_mysql \
&& usermod -u 1000 www-data
