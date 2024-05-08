#!/usr/bin/env bash
echo "Running composer"
cp /etc/secrets/.env .env
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Ruuning Seeders..."
php artisan db:seed PermissionsSeeder

echo "Running npm depedencies..."
echo "installs NVM (Node Version Manager)"
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash

echo "download and install Node.js"
nvm install 20

echo "verifies the right Node.js version is in the environment"
node -v # should print `v20.13.0`

echo "verifies the right NPM version is in the environment"
npm -v # should print `10.5.2`

echo "Running static elemenrs..."
npm run dev



echo "done deploying"