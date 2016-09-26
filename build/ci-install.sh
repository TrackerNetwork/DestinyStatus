#! /usr/bin/env bash
set -e

composer install
php artisan key:generate

npm install -g gulp
npm install
