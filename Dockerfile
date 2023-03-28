FROM php:8.1-fpm AS base
WORKDIR /app/
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt -y update \
        && apt install -y g++ git nginx libicu-dev zip libzip-dev libpq-dev \
        && docker-php-ext-install intl opcache pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

FROM base AS composer
COPY composer.lock composer.json /app/
RUN composer install -n \
    --no-progress \
    --no-plugins \
    --no-autoloader \
    --no-scripts \
    --no-suggest

FROM base
COPY --from=composer /app/vendor /app/vendor

#entrypoint
COPY ./infrastructure/docker/scripts/php-nginx/entrypoint.sh /etc/service/
#nginx config
COPY ./infrastructure/docker/config/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY . .

RUN composer dump-autoload --optimize
RUN chmod -R 777 /app/storage

RUN chmod +x /etc/service/entrypoint.sh
CMD ["/etc/service/entrypoint.sh"]
