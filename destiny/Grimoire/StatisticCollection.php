<?php

namespace Destiny\Grimoire;

use Destiny\Collection;

/**
 * @method \Destiny\Grimoire\Statistic offsetGet($key)
 */
class StatisticCollection extends Collection
{
    public function __construct(Card $card, array $items = null)
    {
        if (is_array($items)) {
            foreach ($items as $properties) {
                $statistic = new Statistic($card, $properties);

                if ($statistic->value || $statistic->hasRanks()) {
                    $this->items[$statistic->statNumber] = $statistic;
                }
            }
        }
    }
}
