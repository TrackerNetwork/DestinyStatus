<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\Collections\ActivityTierCollection;
use Destiny\Definitions\SkullModifier;

/**
 * @property string $progressionHash
 * @property ActivityTierCollection $activityTiers
 * @property SkullModifier[] $skulls
 * @property \Destiny\Definitions\Activity $definition
 */
class WrathOfTheMachine extends Activity implements ActivityInterface
{
    const FeaturedWoTM = 336249023;

    public function __construct(array $items, array $properties)
    {
        // HOTFIX - Add in T3 (390LL)
        if (count($properties['activityTiers']) === 2) {

            // WoTM is the weekly raid. Lets add the skulls
            if ($items['weeklyfeaturedraid']['activityTiers'][0]['activityHash'] === self::FeaturedWoTM) {
                $skullCategory = $items['weeklyfeaturedraid']['activityTiers'][0]['skullCategories'];
                $completion = $items['weeklyfeaturedraid']['activityTiers'][0]['completion'];
                $identifier = self::FeaturedWoTM;
            } else {
                $skullCategory = [
                    0 => [
                        'title'  => 'Modifiers',
                        'skulls' => [
                            0 => [
                                'displayName' => 'Heroic',
                                'description' => 'Enemies appear in greater numbers and are more aggressive.',
                                'icon'        => '/common/destiny_content/icons/18a687233d633b1e4c34e0b25e6235cb.png',
                            ],
                        ],
                    ],
                ];
                $completion = [
                    'complete' => false,
                    'success'  => false,
                ];
                $identifier = 430160982;
            }
            $properties['activityTiers'][] = [
                'activityHash'    => $identifier,
                'tierDisplayName' => 'Hard',
                'completion'      => $completion,
                'steps'           => [
                    ['complete' => false],
                    ['complete' => false],
                    ['complete' => false],
                    ['complete' => false],
                    ['complete' => false],
                ],
                'skullCategories' => $skullCategory,
                'rewards'         => [],
                'activityData'    => [
                    'activityHash'     => 430160982,
                    'isNew'            => false,
                    'canLead'          => true,
                    'canJoin'          => true,
                    'isCompleted'      => true,
                    'isVisible'        => true,
                    'displayLevel'     => 42,
                    'recommendedLight' => 390,
                    'difficultyTier'   => 2,
                ],
            ];
        }

        $properties['activityTiers'] = (new ActivityTierCollection($this, $properties['activityTiers']));
        $skullsCategories = $properties['activityTiers']->first()['skullCategories'];
        $properties['definition'] = $properties['activityTiers']->first()['definition'];

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
        return 'wrathofthemachine';
    }
}
