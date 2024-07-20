#!/bin/bash

set -e

echo "Starting deployment..."

echo "Pulling latest changes..."
git pull origin master

echo "Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "Running database migrations..."
php bin/migrate.php

echo "Clearing caches..."
php bin/clear-cache.php


echo "Deployment completed successfully!"

