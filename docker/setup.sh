#!/bin/bash

echo "Creating Laravel Storage"
mkdir -p /var/www/storage/app
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/logs
chmod 777 -R /var/www/storage

echo "Owning /var/www"
chown -R www-data:www-data /var/www

echo "Composer install"
cd /var/www && composer install -vvv

echo "Done"
