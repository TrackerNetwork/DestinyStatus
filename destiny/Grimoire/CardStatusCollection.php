<?php

namespace Destiny\Grimoire;

use Destiny\Collection;
use Destiny\Grimoire;

/**
 * @method \Destiny\Grimoire\CardStatus offsetGet($key)
 */
class CardStatusCollection extends Collection
{
    public function __construct(Grimoire $grimoire, array $items = null)
    {
        if (is_array($items)) {
            foreach ($items as $properties) {
                $cardStatus = new CardStatus($grimoire, $properties);
                $this->items[$cardStatus->cardId] = $cardStatus;
            }
        }
    }
}
