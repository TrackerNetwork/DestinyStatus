<?php

declare(strict_types=1);

namespace Destiny;

use Destiny\Definitions\LeaderboardEntry;
use Illuminate\Support\Collection;

/**
 * @method \Destiny\Definitions\LeaderboardEntry offsetGet($key)
 */
class LeaderboardEntryCollection extends Collection
{
    /**
     * LeaderboardEntryCollection constructor.
     *
     * @param array|mixed $items
     */
    public function __construct($items)
    {
        $rankings = [];

        foreach ($items as $item) {
            $rankings[$item['rank']] = is_array($item) ? new LeaderboardEntry($item) : $item;
        }

        parent::__construct(array_slice($rankings, 0, 10));
    }
}
