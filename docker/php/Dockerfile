FROM php:8.1-fpm-alpine3.18

WORKDIR /var/www

COPY --from=composer:2.6.5 /usr/bin/composer /usr/bin/composer
RUN composer require --dev phpunit/phpunit ^10.0.19

RUN echo 'alias phpunit="/var/www/vendor/phpunit/phpunit/phpunit"' >> ~/.bashrc