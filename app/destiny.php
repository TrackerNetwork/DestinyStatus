<?php

namespace App;

class DestinyException extends \Exception
{
}
class DestinyLegacyPlatformException extends \Exception
{
}
class UnknownPlayerException extends DestinyException
{
}
class FailingTooHardException extends \Exception
{
}

/**
 * @return \Carbon\Carbon
 */
function next_daily()
{
    static $date;

    if (!$date) {
        $date = carbon('this day 9:00 AM Z');

        if ($date->isPast()) {
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

    if (!$date) {
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

    if (!$date) {
        $date = carbon('this tuesday 9:00 AM Z');

        if ($date->isPast()) {
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

    if (!$date) {
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