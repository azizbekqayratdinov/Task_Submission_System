#!/bin/bash
set -e

# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate application key if not set
php artisan key:generate --force

# Clear caches
php artisan cache:clear
php artisan config:clear

# Run migrations
php artisan migrate --force

# Start PHP built-in server
php artisan serve --host=0.0.0.0 --port=$PORT