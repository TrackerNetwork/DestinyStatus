<?php

namespace App\Enums;

/**
 * Class StatsCategoryType.
 */
abstract class StatsCategoryType
{
    const NONE = 0;

    const KILLS = 1;

    const ASSISTS = 2;

    const DEATHS = 3;

    const CRITICALS = 4;

    const KDA = 5;

    const KD = 6;

    const SCORE = 7;

    const ENTERED = 8;

    const TIME_PLAYED = 9;

    const MEDAL_WINS = 10;

    const MEDAL_GAMES = 11;

    const MEDAL_SPECIAL_KILLS = 12;

    const MEDAL_SPREES = 13;

    const MEDAL_MULTI_KILLS = 14;

    const MEDAL_ABILITIES = 15;
}
