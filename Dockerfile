FROM php:8.3-apache

# PHP extensions required for Laravel + SQLite + Node.js for Vite
RUN apt-get update && apt-get install -y git zip unzip libsqlite3-dev nodejs npm \
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
RUN composer install && composer dump-autoload --optimize

# Build frontend assets
RUN npm install && npm run build && rm -rf node_modules

# Configure Apache to serve from /public (Laravel's entry point)
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Create the SQLite file and bake a migrated + seeded database into the image.
# Hosts with a persistent volume (GCP) shadow this with their own data; hosts
# with an ephemeral filesystem (Render) get a ready-to-browse demo on every boot.
RUN touch database/database.sqlite \
    && cp .env.example .env \
    && php artisan key:generate \
    && php artisan migrate --force \
    && php artisan db:seed --force \
    && php artisan storage:link \
    && rm .env

# Grant permissions to Apache (www-data)
RUN chown -R www-data:www-data storage database bootstrap/cache \
    && chmod -R 775 storage database bootstrap/cache

COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

CMD ["entrypoint.sh"]
