<?php
declare(strict_types = 1);

namespace App\Helpers;

use Illuminate\Support\Str;

class DestinyHelper
{
    public static function bungie(string $url): string
    {
        if (Str::startsWith($url, 'http')) {
            return $url;
        }

        return url('https://www.bungie.net'.$url);
    }
}