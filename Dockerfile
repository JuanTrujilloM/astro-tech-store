FROM php:8.2-apache

# PHP extensions required for Laravel + SQLite
RUN apt-get update && apt-get install -y git zip unzip libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && apt-get clean

# Enable mod_rewrite so Laravel routes work
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Working directory inside the container
WORKDIR /var/www/html

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --no-scripts

# Configure Apache to serve from /public (Laravel's entry point)
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Create SQLite file and grant permissions to Apache (www-data)
RUN touch database/database.sqlite \
    && chown -R www-data:www-data storage database bootstrap/cache \
    && chmod -R 775 storage database bootstrap/cache

EXPOSE 80

# On startup: run migrations then start Apache
CMD php artisan migrate --force && apache2-foreground
