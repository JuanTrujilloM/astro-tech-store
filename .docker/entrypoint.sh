#!/bin/sh
set -e

# Platforms such as Render assign the listening port at runtime through $PORT.
# When it is not set the container keeps its original behaviour (port 80),
# which is what the GCP VM deployment relies on.
PORT="${PORT:-80}"

sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

php artisan migrate --force

exec apache2-foreground
