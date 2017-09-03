<?php

declare(strict_types=1);

namespace Destiny\Profile\Progression;

use Destiny\Collection;
use Destiny\Definitions\Progression\ItemObjective;

/**
 * Class UninstancedItemObjectiveCollection.
 */
class UninstancedItemObjectiveCollection extends Collection
{
    public function __construct(array $properties)
    {
        $itemObjectives = [];

        foreach ($properties as $itemObjectiveHash => $itemObjective) {
            $itemObjectives[$itemObjectiveHash] = new ItemObjective($itemObjective);
        }

        parent::__construct($itemObjectives);
    }
}