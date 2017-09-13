<?php

declare(strict_types=1);

namespace Destiny;

use Destiny\Definitions\Leaderboard;
use Destiny\Definitions\LeaderboardEntry;
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
        return array_get($this->items, $key, new Leaderboard(['statId' => $key]));
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

    // KD & KAD don't exist in API. Lets make it ourself mocking the exact elements the view needs
    // to generate
    public function getKd()
    {
        $kd = new Leaderboard();
        $kd->setCachedProperty('statName', 'KD Ratio');
        $kd->setCachedProperty('statId', 'kd-ratio');

        $tmp_kills = [];
        foreach ($this->lbKills->rankings as $rank) {
            $tmp_kills[$rank->name] = $rank->value;
        }

        $tmp_deaths = [];
        foreach ($this->lbDeaths->rankings as $rank) {
            $tmp_deaths[$rank->name] = $rank->value;
        }

        $tmp_kd = [];
        foreach ($tmp_kills as $name => $value) {
            $deaths = $tmp_deaths[$name] ?? 1;

            $entry = new LeaderboardEntry();
            $entry->setCachedProperty('value', $value / $deaths);
            $entry->setCachedProperty('displayValue', round($entry->value, 2));
            $entry->setCachedProperty('name', $name);

            $tmp_kd[] = $entry;
        }

        $tmp_kd = collect($tmp_kd)->sortByDesc(function(LeaderboardEntry $item) {
            return $item->value;
        });

        $kd->setCachedProperty('rankings', $tmp_kd);

        return $kd;
    }

    public function getKad()
    {
        $kad = new Leaderboard();
        $kad->setCachedProperty('statName', 'KAD Ratio');
        $kad->setCachedProperty('statId', 'kad-ratio');

        $tmp_kills = [];
        foreach ($this->lbKills->rankings as $rank) {
            $tmp_kills[$rank->name] = $rank->value;
        }

        $tmp_deaths = [];
        foreach ($this->lbDeaths->rankings as $rank) {
            $tmp_deaths[$rank->name] = $rank->value;
        }

        $tmp_assists = [];
        foreach ($this->lbAssists->rankings as $rank) {
            $tmp_assists[$rank->name] = $rank->value;
        }

        $tmp_kad = [];
        foreach ($tmp_kills as $name => $value) {
            $deaths = $tmp_deaths[$name] ?? 1;
            $assists = $tmp_assists[$name] ?? 0;

            $entry = new LeaderboardEntry();
            $entry->setCachedProperty('value', ($value + $assists) / $deaths);
            $entry->setCachedProperty('displayValue', round($entry->value, 2));
            $entry->setCachedProperty('name', $name);

            $tmp_kad[] = $entry;
        }

        $tmp_kad = collect($tmp_kad)->sortByDesc(function(LeaderboardEntry $item) {
            return $item->value;
        });

        $kad->setCachedProperty('rankings', $tmp_kad);

        return $kad;
    }
}
