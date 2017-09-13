<?php

namespace Destiny;

use Destiny\Definitions\AccountStats as StatDefinition;
use Destiny\Definitions\Leaderboard;

/**
 * Class LeaderboardHandler.
 *
 * @property Leaderboard $allPvP
 * @property Leaderboard $allPvE
 */
class LeaderboardHandler extends StatDefinition
{
    /**
     * Manifest constructor.
     *
     * @param array|null $properties
     */
    public function __construct(array $properties = null)
    {
        $leaderboards = [];

        // foreach categories, insert them as collections
        foreach ($properties as $category => $entries) {
            $leaderboards[$category] = new LeaderboardCollection($entries);
        }

        parent::__construct($leaderboards);
    }
}
