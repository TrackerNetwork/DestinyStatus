<?php

namespace App\Enums;

/**
 * Class ItemType
 * @package App\Enums
 */
abstract class ItemType
{
    const None = 0;

    const Currency = 1;

    const Armor = 2;

    const Weapon = 3;

    const Message = 7;

    const Engram = 8;

    const Consumable = 9;

    const ExchangeMaterial = 10;

    const MissionReward = 11;

    const QuestStep = 12;

    const QuestStepComplete = 13;

    const Emblem = 14;

    const Quest = 15;

    const Subclass = 16;

    const ClanBanner = 17;

    const Aura = 18;

    const Mod = 19;
}
