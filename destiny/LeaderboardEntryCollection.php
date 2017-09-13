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
    public function __construct(array $items)
    {
        $rankings = [];

        foreach ($items as $item) {
            $rankings[$item['rank']] = new LeaderboardEntry($item);
        }

        parent::__construct(array_slice($rankings, 0, 10));
    }
}
