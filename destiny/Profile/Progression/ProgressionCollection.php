<?php

declare(strict_types=1);

namespace Destiny\Profile\Progression;

use Destiny\Collection;
use Destiny\Definitions\Progression\Progression;

/**
 * Class ProgressionCollection.
 */
class ProgressionCollection extends Collection
{
    public function __construct(array $properties)
    {
        $progressions = [];

        foreach ($properties as $progressionHash => $progression) {
            $progressions[$progressionHash] = new Progression($progression);
        }

        parent::__construct($progressions);
    }
}
