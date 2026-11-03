#!/usr/bin/env bash
echo "Running Sahaara startup script..."

php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ -f /var/www/html/database/database.sqlite ]; then
    chmod 777 /var/www/html/database/database.sqlite
fi

echo "Startup complete!"

