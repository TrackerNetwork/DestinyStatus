<?php

namespace Destiny\Definitions\Activity;

use Destiny\Definitions\Definition;

/**
 * Class MatchmakingBlock
 * @package Destiny\Definitions
 * @property bool $isMatchmade
 * @property int $minParty
 * @property int $maxParty
 * @property int $maxPlayers
 * @property bool $requiresGuardianOath
 */
class MatchmakingBlock extends Definition
{
    protected $appends = [

    ];
}