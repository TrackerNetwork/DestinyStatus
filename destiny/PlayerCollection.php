<?php

namespace Destiny;

/**
 * @method \Destiny\Player offsetGet($key)
 */
class PlayerCollection extends Collection
{
    public function __construct($gamertag, array $items)
    {
        foreach ($items as $properties) {
            $player = new Player($properties);

            if (slug($player->displayName) == slug($gamertag)) {
                $this->items[$player->platform] = $player;
            }
        }
    }
}
