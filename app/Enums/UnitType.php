<?php

namespace App\Enums;

/**
 * Class UnitType.
 */
abstract class UnitType
{
    const NONE = 0;

    /**
     * Indicates the statistic is a simple count of something.
     */
    const COUNT = 1;

    /**
     * Indicates the statistic is a per game average.
     */
    const PER_GAME = 2;

    const SECONDS = 3;

    const POINTS = 4;

    const TEAM = 5;

    const DISTANCE = 6;

    const PERCENT = 7;

    const RATIO = 8;

    const BOOLEAN = 9;

    const WEAPON_TYPE = 10;

    const STANDING = 11;

    const MILLISECONDS = 12;
}
