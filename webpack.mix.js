let mix = require('laravel-mix');

var config = {
    node: "node_modules/"
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix
   // .js('resources/assets/js/app.js', 'public/js')
    .scripts([
        config.node + 'bootstrap-3-typeahead/bootstrap3-typeahead.js',
        config.node + 'jquery.cookie/jquery.cookie.js'
    ], 'public/js/vendor.js')
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/bootstrap.js', 'public/js')
    .js('resources/assets/js/destiny.js', 'public/js')
    .sass('resources/assets/sass/destiny.scss', 'public/css')
    .copyDirectory('resources/assets/img', 'public/img')
    .version();
