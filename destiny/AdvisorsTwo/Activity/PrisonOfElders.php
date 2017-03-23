<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\Collections\ActivityTierCollection;

/**
 * @property string $progressionHash
 * @property ActivityTierCollection $activityTiers
 */
class PrisonOfElders extends Activity implements ActivityInterface
{
    public function __construct(Advisors $advisors, array $properties)
    {
        $properties['activityTiers'] = (new ActivityTierCollection($this, $properties['activityTiers']));
        parent::__construct($properties);
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'prisonofelders';
    }
}
