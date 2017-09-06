<?php

declare(strict_types=1);

namespace Destiny\Profile\Progression;

use Destiny\Collection;
use Destiny\Definitions\Progression\Faction;

/**
 * Class FactionCollection.
 */
class FactionCollection extends Collection
{
    public function __construct(array $properties)
    {
        $factions = [];

        foreach ($properties as $progressionHash => $faction) {
            $factions[$progressionHash] = new Faction($faction);
        }

        parent::__construct($factions);
    }
}
