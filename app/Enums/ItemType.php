<?php

namespace App\Enums;

/**
 * Class ItemType.
 */
abstract class ItemType
{
    const NONE = 0;

    const CURRENCY = 1;

    const ARMOR = 2;

    const WEAPON = 3;

    const MESSAGE = 7;

    const ENGRAM = 8;

    const CONSUMABLE = 9;

    const EXCHANGE_MATERIAL = 10;

    const MISSION_REWARD = 11;

    const QUEST_STEP = 12;

    const QUEST_STEP_COMPLETE = 13;

    const EMBLEM = 14;

    const QUEST = 15;

    const SUBCLASS = 16;

    const CLAN_BANNER = 17;

    const AURA = 18;

    const MOD = 19;
}
