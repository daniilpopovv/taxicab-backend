#!/bin/bash -E

php artisan migrate
service nginx start
exec php-fpm -F
