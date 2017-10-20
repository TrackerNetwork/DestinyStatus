<?php

namespace Destiny\Activity;

use Destiny\Collection;
use Destiny\Definitions\Statistic;

/**
 * Class ActivityStatCollection
 * @package Destiny
 */
class ActivityStatCollection extends Collection
{
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
        return array_get($this->items, $key, new Statistic(['activityHash' => $key]));
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
