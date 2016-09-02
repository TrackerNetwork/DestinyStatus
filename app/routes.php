<?php

// Routes

Route::pattern('platform', 'psn|xbl');

Route::any('/',                   ['uses' => 'HomeController@index',
	'as' => 'home']);

Route::any('/privacy',            ['uses' => 'HomeController@privacy',
	'as' => 'privacy']);

Route::get('select/{gamertag}',   ['uses' => 'HomeController@select',
	'as' => 'select']);

Route::group(['prefix' => '{platform}/{player}'], function()
{
	Route::get('/',        ['uses' => 'AccountController@index',    'as' => 'account']);
	Route::get('grimoire', ['uses' => 'AccountController@grimoire', 'as' => 'grimoire']);
});
