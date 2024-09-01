#!/bin/bash

Wait for MySQL to be ready
echo "Waiting for MySQL..."
while ! mysqladmin ping -h"$DB_HOST" --silent; do
    sleep 3
done

# Ensure APP_KEY is set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Run Laravel setup commands
php artisan migrate
php artisan config:cache
php artisan route:cache


# Execute the main process (Apache)
exec "$@"
