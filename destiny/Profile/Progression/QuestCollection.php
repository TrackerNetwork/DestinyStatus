<?php

declare(strict_types=1);

namespace Destiny\Profile\Progression;

use Destiny\Collection;
use Destiny\Definitions\Progression\Quest;

/**
 * Class QuestCollection.
 */
class QuestCollection extends Collection
{
    public function __construct(array $properties)
    {
        $quests = [];

        foreach ($properties as $questHash => $quest) {
            $quests[$questHash] = new Quest($quest);
        }

        parent::__construct($quests);
    }
}
