<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\Collections\ActivityTierCollection;
use Destiny\Definitions\Objective;
use Destiny\Definitions\SkullModifier;

/**
 * @property string $progressionHash
 * @property ActivityTierCollection $activityTiers
 * @property SkullModifier[] $skulls
 * @property Objective[] $objectives
 */
class ElderChallenge extends Activity implements ActivityInterface
{
    public function __construct(array $items, array $properties)
    {
        if (isset($properties['extended']['skullCategories'])) {
            $skulls = [];
            foreach ($properties['extended']['skullCategories'] as $skullCategory) {
                foreach ($skullCategory['skulls'] as $skull) {
                    $skull = new SkullModifier($skull);
                    $skull->isModifier = $skullCategory['title'] === 'Modifiers';
                    $skulls[] = $skull;
                }
            }
            $properties['skulls'] = $skulls;
        }

        if (isset($properties['extended']['objectives'])) {
            $objectives = [];
            foreach ($properties['extended']['objectives'] as $objective) {
                $objective = new Objective($objective);
                $objectives[] = $objective;
            }
            $properties['objectives'] = $objectives;
        }

        $properties['activityTiers'] = (new ActivityTierCollection($this, $properties['activityTiers']));
        parent::__construct($properties);
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'elderchallenge';
    }
}
