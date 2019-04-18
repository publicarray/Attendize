#!/bin/sh

# /usr/bin/php /usr/local/bin/composer install --no-dev
composer install --no-dev
brew services start mariadb
valet install
