## DestinyStatus

### Community, please help us build this site! We are accepting all pull-requests that are in the spirit of the site.  For all other ideas and concepts, please create an issue, we can figure out something! 

This project is based on the Laravel framework [v4.2].

Please [read these instructions](https://laravel.com/docs/4.2#server-requirements) on how to configure your server to get started.

### Project dependecies:

* PHP >= 5.4
* Mcrypt extension
* [Node.js](https://nodejs.org)
* [Composer](https://getcomposer.org)

### Install the framework

1. `composer install`
2. `php artisan key:generate`

### Compile CSS/JS

1. Install bower: `npm install -g bower`
2. Install gulp: `npm install -g gulp`
3. Install dependencies:
    * `bower install`
    * `npm install`
4. Build:
    * Local: `gulp`
    * Production: `gulp --production`
