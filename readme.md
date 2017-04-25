## DestinyStatus

[![Join the chat at https://gitter.im/TrackerNetwork/DestinyStatus](https://badges.gitter.im/TrackerNetwork/DestinyStatus.svg)](https://gitter.im/TrackerNetwork/DestinyStatus?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge) [![Build Status](https://travis-ci.org/TrackerNetwork/DestinyStatus.svg?branch=master)](https://travis-ci.org/TrackerNetwork/DestinyStatus)

##### Community, please help us build this site! We are accepting all pull-requests that are in the spirit of the site.  For all other ideas and concepts, please create an issue, we can figure out something!

This project is based on the Laravel framework [v5.1].

Please [read these instructions](https://laravel.com/docs/5.1#server-requirements) on how to configure your server to get started.

### Project dependecies:

* PHP >= 5.5
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
5. `composer install`
6. `php artisan key:generate`

### Compile CSS/JS

1. Install gulp: `npm install -g gulp`
2. Install npm dependencies: `yarn install`
3. Build:
    * Local: `gulp`
    * Production: `gulp --production`