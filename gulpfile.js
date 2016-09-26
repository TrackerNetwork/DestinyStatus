var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

var config = {
    node: "../../../node_modules/"
};

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'destiny.scss'
    ], 'public/css/destiny.css');

    mix.scripts([
        config.node + 'jquery/dist/jquery.js',
        config.node + 'jquery.cookie/jquery.cookie.js',
        config.node + 'bootstrap-sass/assets/javascripts/bootstrap/tab.js',
        config.node + 'bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
        config.node + 'bootstrap-sass/assets/javascripts/bootstrap/popover.js',
        config.node + 'bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
        'destiny.js'
    ], 'public/js/destiny.js');

    mix.version(['css/destiny.css', 'js/destiny.js']);

    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
    mix.copy('resources/assets/img', 'public/img');
});
