<?php

namespace Destiny;

use Illuminate\Support\Collection;

/**
 * @method \Destiny\Player offsetGet($key)
 */
class PlayerCollection extends Collection
{
    /**
     * PlayerCollection constructor.
     *
     * @param array|mixed $gamertag
     * @param array       $items
     */
    public function __construct($gamertag, array $items)
    {
        $players = [];
        foreach ($items as $properties) {
            $player = new Player($properties);

            if (slug($player->displayName) == slug($gamertag)) {
                $players[$player->platform] = $player;
            }
        }

        parent::__construct($players);
    }
}
