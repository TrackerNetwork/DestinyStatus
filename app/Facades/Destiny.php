<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Destiny extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Destiny\Destiny::class;
    }
}
