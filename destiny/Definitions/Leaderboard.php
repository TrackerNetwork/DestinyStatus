<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Manifest\HistoricalStat;
use Destiny\LeaderboardEntryCollection;

/**
 * Class Leaderboard.
 *
 * @property string $statId
 * @property array $entries
 * @property HistoricalStat $definition
 * @property-read LeaderboardEntryCollection $rankings
 */
class Leaderboard extends Definition
{
    protected function gDefinition()
    {
        return manifest()->historicalStat($this->statId);
    }

    protected function gStatName()
    {
        return $this->definition->statName;
    }

    protected function gRankings()
    {
        return new LeaderboardEntryCollection($this->entries);
    }
}
