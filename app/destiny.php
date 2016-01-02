<?php

/** @var bool $cachePlayer */
$cacheEnabled = (Input::get('cache', true) ? Config::get('destiny.cache', true) : false);
/** @var int $cachePlayer */
$cacheDefault = (Input::get('cache', true) ? Config::get('destiny.cache_default', false) : false);
/** @var int $cachePlayer */
$cachePlayer  = Config::get('destiny.cache_player', 60*24*7*2);

define('CACHE_ENABLED', $cacheEnabled);
define('CACHE_DEFAULT', $cacheDefault);
define('CACHE_PLAYER',  $cachePlayer);

class DestinyException extends Exception {}
class UnknownPlayerException extends DestinyException {}
class FailingTooHardException extends Exception {}

/**
 * @return \Carbon\Carbon
 */
function next_daily()
{
	static $date;

	if ( ! $date)
	{
		$date = carbon('this day 9:00 AM Z');

		if ($date->isPast())
		{
			$date = carbon('next day 9:00 AM Z');
		}
	}

	return $date;
}

/**
 * @return \Carbon\Carbon
 */
function last_daily()
{
	static $date;

	if ( ! $date)
	{
		$date = clone next_daily();
		$date->subDay();
	}

	return $date;
}

/**
 * @return \Carbon\Carbon
 */
function next_weekly()
{
	static $date;

	if ( ! $date)
	{
		$date = carbon('this tuesday 9:00 AM Z');

		if ($date->isPast())
		{
			$date = carbon('next tuesday 9:00 AM Z');
		}
	}

	return $date;
}

/**
 * @return \Carbon\Carbon
 */
function last_weekly()
{
	static $date;

	if ( ! $date)
	{
		$date = clone next_weekly();
		$date->subWeek();
	}

	return $date;
}

/**
 * @return \Destiny\Destiny
 */
function destiny()
{
	return app('destiny');
}

/**
 * @return \Destiny\DestinyClient
 */
function client()
{
	return app('destiny.client');
}

/**
 * @return \Destiny\DestinyManifest
 */
function manifest()
{
	return app('destiny.manifest');
}

/**
 * @return \Destiny\DestinyPlatform
 */
function platform()
{
	return app('destiny.platform');
}
