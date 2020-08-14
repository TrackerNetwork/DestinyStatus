<?php

namespace Destiny\Definitions\Components;

use Destiny\Definitions\Definition;
use Destiny\Player;

/**
 * Class Profile.
 *
 * @property array  $userInfo
 * @property string $dateLastPlayed
 * @property int    $versionsOwned
 * @property array  $characterIds
 * @property-read Player $player
 */
class Profile extends Definition
{
    protected $appends = [
        'player',
    ];

    protected function gPlayer()
    {
        return new Player($this->properties['userInfo']);
    }
}
