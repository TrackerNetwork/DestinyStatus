<?php

namespace App\Enums;

/**
 * Class StatsCategoryType
 * @package App\Enums
 */
abstract class StatsCategoryType
{
    const None = 0;

    const Kills = 1;

    const Assists = 2;

    const Deaths = 3;

    const Criticals = 4;

    const KDa = 5;

    const KD = 6;

    const Score = 7;

    const Entered = 8;

    const TimePlayed = 9;

    const MedalWins = 10;

    const MedalGames = 11;

    const MedalSpecialKills = 12;

    const MedalSprees = 13;

    const MedalMultiKills = 14;

    const MedalAbilities = 15;
}
