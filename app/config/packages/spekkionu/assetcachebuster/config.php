<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Asset Cache Enabled
    |--------------------------------------------------------------------------
    |
    | If this is set to true the asset urls will be prefixed with a hash to allow
    | for cache invalidation.
    |
    | Setting this to false will not prefix urls with the hash effectively disabling
    | the package.  This can be helpful to not use the hash prefix for development
    | environments.
    |
    | Asset urls will still be prefixed with the cdn url.  This setting has no effect
    | on that.
    |
    */

    'enable' => true,

    /*
    |--------------------------------------------------------------------------
    | Asset Cache Prefix Hash
    |--------------------------------------------------------------------------
    |
    | Asset urls will be prefixed with this hash for browser cache busting.
    | This allows a long expires header to be set for asset files while
    | still providing an easy way to force download of new versions of files.
    |
    | Change this hash to invalidate asset caches.
    | It must be a 32 character string with only the characters 0-9 and a-f
    | or the rewrite rule will need to be modified to match the used pattern.
    |
    | If set to null urls will not be rewritten effectively disabling the package.
    |
    | You can run "php artisan assetcachebuster:generate" to automatically generate
    | a new hash.
    |
    */

    'hash' => md5(version()),

    /*
    |--------------------------------------------------------------------------
    | Asset Path Prefix
    |--------------------------------------------------------------------------
    |
    | If all of the assets you want cached are in a directory you may limit
    | the caching to only that directory.
    |
    | If this is set you must also modify the rewrite rule.
    | For example if your assets are all inside a directory named "assets"
    | Set this value to "assets" and modify the rewrite rule to
    | RewriteRule ^assets/[a-f0-9]{32}/(.*)$ assets/$1 [L]
    |
    | You can also prefix urls to avoid clashes with any laravel routes.
    | For example if you have a route that begins with a md5 hash
    | this package will prevent that route from working normally.
    | To get around this set this prefix to a unique value that wont appear
    | in any of your routes.
    | Say you want to use the prefix cachedasset
    | Set the rewrite rule to the following
    | RewriteRule ^cachedasset/[a-f0-9]{32}/(.*)$ $1 [L]
    |
    */
    'prefix' => null,


    /*
    |--------------------------------------------------------------------------
    | CDN URL
    |--------------------------------------------------------------------------
    |
    | The cdn url.
    | If null no cdn will be used.
    |
    */
    'cdn' => null,

);
