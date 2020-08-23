<?php

namespace App\Enums;

/**
 * Class StatGroupType.
 */
abstract class StatGroupType
{
    const NONE = 0;

    const GENERAL = 1;

    const WEAPONS = 2;

    const MEDALS = 3;

    const RESERVED_GROUPS = 100;

    const LEADERBOARD = 101;

    const ACTIVITY = 102;

    const UNIQUE_WEAPON = 103;

    const INTERNAL = 104;
}
