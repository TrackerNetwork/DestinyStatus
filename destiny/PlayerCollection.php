<?php

declare(strict_types=1);

namespace Destiny;

use App\Helpers\StringHelper;
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
    public function __construct(string $gamertag, array $items)
    {
        $players = [];
        foreach ($items as $properties) {
            $player = new Player($properties);

            if (StringHelper::bungieSlug($player->displayName) == StringHelper::bungieSlug($gamertag)) {
                $players[$player->platform] = $player;
            }
        }

        parent::__construct($players);
    }
}
