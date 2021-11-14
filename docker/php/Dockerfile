FROM php:8.0-fpm

RUN apt-get update

RUN usermod -u 1000 www-data -s /bin/bash && groupmod -g 1000 www-data

RUN apt-get install -y automake autoconf \
 pngquant libpng-dev libxrender1 libfontconfig libxext6 fonts-ipafont \
 curl vim wget libzip-dev libpq-dev zip unzip


# pdo
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql gd zip


# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# xdebug
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug


# web root
WORKDIR /var/www/html


