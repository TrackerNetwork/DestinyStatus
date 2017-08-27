<?php

namespace App\Enums;

/**
 * Class UnitType.
 */
abstract class UnitType
{
    const None = 0;

    /**
     * Indicates the statistic is a simple count of something.
     */
    const Count = 1;

    /**
     * Indicates the statistic is a per game average.
     */
    const PerGame = 2;

    const Seconds = 3;

    const Points = 4;

    const Team = 5;

    const Distance = 6;

    const Percent = 7;

    const Ratio = 8;

    const Boolean = 9;

    const WeaponType = 10;

    const Standing = 11;

    const Milliseconds = 12;
}
