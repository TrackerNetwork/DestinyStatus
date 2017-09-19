## DestinyStatus

[![Join the chat at https://gitter.im/TrackerNetwork/DestinyStatus](https://badges.gitter.im/TrackerNetwork/DestinyStatus.svg)](https://gitter.im/TrackerNetwork/DestinyStatus?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge) [![Build Status](https://travis-ci.org/TrackerNetwork/DestinyStatus.svg?branch=master)](https://travis-ci.org/TrackerNetwork/DestinyStatus)

This project is based on the Laravel framework [v5.5].

Please [read these instructions](https://laravel.com/docs/5.5#server-requirements) on how to configure your server to get started.

### Understanding Branches

* `master` 	- developer branch of production destinystatus.com
* `destiny1` 	- legacy version of d1.destinystatus.com
* `legacy` 	- original Laravel 4.2 version of d1 destinystatus
* `production`  - production destinystatus.com (follows `master`)

### Project dependecies:

* PHP >= 7.0
  * zip extension
  * sqlite3 extension
* Mcrypt extension
* [Node.js](https://nodejs.org)
* [Composer](https://getcomposer.org)

### Install the framework

1. Copy the file `.env.example` to `.env`
2. Edit `.env` with any information needed (Bugsnag, environment)
3. Visit the [Destiny API Registration Portal](https://www.bungie.net/en/user/api) to sign up for an API key
4. Add your key to `.env` under the `DESTINY_KEY`
5. Add your oauth information to `.env` under the `BUNGIE_CLIENT` (client id) and `BUNGIE_SECRET` (client secret) codes.
6. Remember that the API key and oauth information need to be from same Application at Bungie.
7. `composer install`
8. `php artisan key:generate`

### Compile CSS/JS

1. Install yarn: `npm install -g yarn`
2. Install npm dependencies: `yarn install`
3. Build:
    * Local: `yarn run dev`
    * Production: `yarn run prod`
    
    
### Things to know

1. `DESTINY_CACHE_DEFAULT` is the default for endpoint caches. We tend to use 5 minutes. That is enough time for people to load a profile, spam a few clicks around the site and keep getting fed cache values instead of API. Any value over 5 minutes adds a message to the homepage explaining the reason for out of date stats.

2. `PROXY_URL` is the URL to a service that takes a request and simply proxies it onward, this allows us to get around API limits as a server side application cannot issue requests as fast as the users use the product.

3. `BUGSNAG_API_KEY` is for the Bugsnag service. This tracks all PHP/Destiny errors, this lets us quickly know what clan/profile/page is broken.

4. `php artisan destiny:manifest --download` will force a redownload of the Manifest and process all entities into the file system.

5. `php artisan destiny:medal [give|take] gamertag console badge` is the command for giving/taking badges. For example `php artisan destiny:medal give iBot xbl donator` gives iBot on Xbox Live the donator badge.
