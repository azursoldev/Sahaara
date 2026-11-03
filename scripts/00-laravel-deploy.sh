#!/usr/bin/env bash
echo "Running Sahaara startup script..."

mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/database

if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    chmod 777 /var/www/html/database/database.sqlite
fi

php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

echo "Startup complete!"
