<?php
declare(strict_types = 1);

namespace App\Helpers;

use Carbon\CarbonImmutable;

class ResetHelper
{
    public static function nextDaily(): CarbonImmutable
    {
        static $date;

        if (!$date) {
            $date = new CarbonImmutable('this day 5:00 PM Z');

            if ($date->isPast()) {
                $date = new CarbonImmutable('next day 5:00 PM Z');
            }
        }

        return $date;
    }

    public static function lastDaily(): CarbonImmutable
    {
        static $date;

        if (!$date) {
            $date = clone self::nextDaily()->subDay();
        }

        return $date;
    }

    public static function nextWeekly(): CarbonImmutable
    {
        static $date;

        if (!$date) {
            $date = new CarbonImmutable('this tuesday 5:00 PM Z');

            if ($date->isPast()) {
                $date = new CarbonImmutable('next tuesday 5:00 PM Z');
            }
        }

        return $date;
    }

    public static function lastWeekly(): CarbonImmutable
    {
        static $date;

        if (!$date) {
            $date = clone self::nextWeekly()->subWeek();
        }

        return $date;
    }
}