<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * @param string $platform
     * @param string $name
     * @return string
     */
    public function index(string $platform, string $name)
    {
        \App::abort(404, 'This page is not yet ready.');
    }
}
