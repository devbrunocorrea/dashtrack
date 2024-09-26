FROM php:7.4-fpm-alpine

RUN apk add --no-cache libzip-dev zlib-dev && docker-php-ext-install pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

CMD ["entrypoint.sh"]