FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

COPY . /var/www/html

ENV WEBROOT /var/www/html/public
ENV PHP_CATCHALL 1
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV SKIP_COMPOSER 1

# Install composer packages during Docker build
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
