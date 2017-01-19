<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Routes
Route::pattern('platform', 'psn|xbl');

Route::any('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::any('/privacy', ['uses' => 'HomeController@privacy', 'as' => 'privacy']);

Route::get('select/{gamertag}', ['uses' => 'HomeController@select', 'as' => 'select']);

Route::group(['prefix' => '{platform}/{player}'], function () {
	Route::get('/', ['uses' => 'AccountController@index', 'as' => 'account']);
	Route::get('grimoire', ['uses' => 'AccountController@grimoire', 'as' => 'grimoire']);
	Route::get('exotics', ['uses' => 'AccountController@exotics', 'as' => 'exotics']);
	Route::get('stats', ['uses' => 'AccountController@stats', 'as' => 'stats']);
});
