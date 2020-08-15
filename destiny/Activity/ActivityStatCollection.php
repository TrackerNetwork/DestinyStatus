<?php

namespace Destiny\Activity;

use Destiny\Collection;
use Destiny\StatisticsCollection;
use Illuminate\Support\Arr;

/**
 * Class ActivityStatCollection.
 */
class ActivityStatCollection extends Collection
{
    // activity ids for normal Leviathan
    const NORMAL_LEVIATHAN = [
        '2693136600',
        '2693136601',
        '2693136602',
        '2693136603',
        '2693136604',
        '2693136605',
    ];

    const PRESTIGE_LEVIATHAN = [
        '2449714930',
        '3446541099',
        '3879860661',
        '417231112',
        '757116822',
        '1685065161',
    ];

    /**
     * ActivityStatCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $statistic = new ActivityStat($item);
            $this->put($statistic->activityHash, $statistic);
        }
    }

    /**
     * @param string $key
     *
     * @return \Destiny\Activity\ActivityStat
     */
    public function offsetGet($key)
    {
        $objects = [];

        switch (true) {
            case in_array($key, self::NORMAL_LEVIATHAN):
                $raidSet = self::NORMAL_LEVIATHAN;
                break;

            case in_array($key, self::PRESTIGE_LEVIATHAN):
                $raidSet = self::PRESTIGE_LEVIATHAN;
                break;

            default:
                return Arr::get($this->items, $key, new ActivityStat(['activityHash' => $key]));
        }

        foreach ($raidSet as $activityHash) {
            $objects[] = Arr::get($this->items, $activityHash, new ActivityStat(['activityHash' => $activityHash]));
        }

        // We only care about the activityCompletions flag, so lets iterate, find and append
        $original = new ActivityStat(['activityHash' => $key]);

        /** @var ActivityStat $object */
        foreach ($objects as $object) {
            if ($object->stats instanceof StatisticsCollection && $object->stats->activityCompletions->value > 0) {
                if (!isset($original->stats)) {
                    $original->setCachedProperty('stats', $object->stats);
                    continue;
                }

                $previousValue = $original->stats->activityCompletions->value;
                $original->stats->activityCompletions->setCachedProperty('value', $previousValue + $object->stats->activityCompletions->value);
            }
        }

        return $original;
    }

    /**
     * @param string $key
     *
     * @return ActivityStat
     */
    public function __get($key)
    {
        return $this->offsetGet($key);
    }
}
