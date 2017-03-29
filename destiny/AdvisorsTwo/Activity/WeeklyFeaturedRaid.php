<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\Collections\ActivityTierCollection;
use Destiny\Definitions\SkullModifier;

/**
 * @property string $progressionHash
 * @property ActivityTierCollection $activityTiers
 * @property SkullModifier[] $skulls
 * @property \Destiny\Definitions\Activity $definition
 */
class WeeklyFeaturedRaid extends Activity implements ActivityInterface
{
    public function __construct(Advisors $advisors, array $properties)
    {
        $properties['activityTiers'] = (new ActivityTierCollection($this, $properties['activityTiers']));
        $skullsCategories = $properties['activityTiers']->first()['skullCategories'];
        $properties['definition'] = $properties['activityTiers']->first()['definition'];
        $properties['activityTier'] = $properties['activityTiers']->first();

        if (is_array($skullsCategories)) {
            $skulls = [];
            foreach ($skullsCategories as $skullCategory) {
                foreach ($skullCategory['skulls'] as $skull) {
                    $skull = new SkullModifier($skull);
                    $skull->isModifier = $skullCategory['title'] === 'Modifiers';
                    $skulls[] = $skull;
                }
            }
            $properties['skulls'] = $skulls;
        }

        parent::__construct($properties);
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'weeklyfeaturedraid';
    }
}
