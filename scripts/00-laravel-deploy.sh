#!/usr/bin/env bash
echo "Running composer"
composer install

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force --seed=PermissionsSeeder


echo "Running npm depedencies..."
npm install

echo "Running static elemenrs..."
npm run dev

echo "Running Web-APP"
php artisan serve