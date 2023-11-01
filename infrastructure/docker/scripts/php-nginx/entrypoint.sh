#!/bin/bash -E

php artisan key:generate
php artisan migrate:fresh
service nginx start
exec php-fpm -F
