#! /usr/bin/env bash
set -e

gem update --system
gem install compass

composer install
php artisan key:generate

npm install -g bower grunt-cli
npm install
bower install
