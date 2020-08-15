<?php

declare(strict_types=1);

namespace Destiny;

use Destiny\Definitions\Leaderboard;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * @property Leaderboard $lbSingleGameKills
 * @property Leaderboard $lbPrecisionKills
 * @property Leaderboard $lbAssists
 * @property Leaderboard $lbKills
 * @property Leaderboard $lbDeaths
 * @property Leaderboard $lbObjectivesCompleted
 * @property Leaderboard $lbSingleGameScore
 * @property Leaderboard $lbMostPrecisionKills
 * @property Leaderboard $lbLongestKillSpree
 * @property Leaderboard $lbLongestKillDistance
 * @property Leaderboard $lbFastestCompletionMs
 * @property Leaderboard $lbLongestSingleLife
 */
class LeaderboardCollection extends Collection
{
    public function __construct(array $items)
    {
        $rankings = [];

        foreach ($items as $item) {
            $rankings[$item['statId']] = new Leaderboard($item);
        }

        parent::__construct($rankings);
    }

    /**
     * @param string $key
     *
     * @return \Destiny\Definitions\Leaderboard
     */
    public function offsetGet($key)
    {
        return Arr::get($this->items, $key, new Leaderboard(['statId' => $key]));
    }

    /**
     * @param string $key
     *
     * @return \Destiny\Definitions\Leaderboard
     */
    public function __get($key)
    {
        return $this->offsetGet($key);
    }
}
