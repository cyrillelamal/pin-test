FROM php:8.1-fpm-alpine3.15

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk add --no-cache bash && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions bcmath pdo_pgsql

WORKDIR /var/www/pin-test

COPY . .

RUN chown -R www-data:www-data . && \
    cp docker-compose/php/wait-for-it.sh /usr/local/bin/wait-for-it.sh && \
    chmod +x /usr/local/bin/wait-for-it.sh && \
    cp .env.example .env && \
    php artisan key:generate
