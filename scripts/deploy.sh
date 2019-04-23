#!/bin/sh


composer install --no-dev
# php artisan migrate --force

# php artisan config:clear
# php artisan view:clear
# php artisan config:cache
# php artisan route:cache
php artisan optimize
