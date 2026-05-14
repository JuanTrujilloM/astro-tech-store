#!/bin/sh
set -e

php artisan migrate --force

PRODUCT_COUNT=$(php -r "
try {
    \$db = new PDO('sqlite:' . getenv('DB_DATABASE'));
    echo \$db->query('SELECT COUNT(*) FROM products')->fetchColumn();
} catch (Exception \$e) {
    echo 0;
}
")

if [ "\$PRODUCT_COUNT" = "0" ]; then
    echo 'Seeding database...'
    php artisan db:seed --force
fi

exec apache2-foreground
