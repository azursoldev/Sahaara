#!/bin/sh

mkdir -p /var/www/html/storage/framework/views /var/www/html/storage/framework/cache /var/www/html/storage/framework/sessions /var/www/html/storage/logs /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    chmod 777 /var/www/html/database/database.sqlite
fi

# Support Railway's dynamic PORT if provided, else default to 80
if [ -n "$PORT" ]; then
    find /etc/nginx -type f -exec sed -i "s/listen 80;/listen ${PORT};/g" {} + 2>/dev/null || true
    find /etc/nginx -type f -exec sed -i "s/listen \[::\]:80;/listen [::]:${PORT};/g" {} + 2>/dev/null || true
fi

exec /start.sh
