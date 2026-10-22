#!/bin/sh
set -eu

cd /var/www/html

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache

key_file="storage/.app-key"

if [ -z "${APP_KEY:-}" ]; then
    if [ ! -s "$key_file" ]; then
        (umask 077 && php artisan key:generate --show --no-ansi > "$key_file")
    fi

    APP_KEY="$(cat "$key_file")"
    export APP_KEY
fi

php artisan storage:link --force
php artisan config:cache
php artisan migrate --force

if [ "${RUN_SEEDER:-false}" = "true" ]; then
    php artisan db:seed --force
fi

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
