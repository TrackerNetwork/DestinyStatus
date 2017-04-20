<?php

namespace Destiny;

use Destiny\AdvisorsTwo\Activity;

/**
 * @method \Destiny\AdvisorsTwo\Activity offsetGet($key)
 */
class AdvisorActivityCollection extends Collection
{
    protected $lookup = [
        'prisonofelders'          => 'PrisonOfElders',
        'elderchallenge'          => 'ElderChallenge',
        'trials'                  => 'Trials',
        'armsday'                 => 'ArmsDay',
        'weeklycrucible'          => 'WeeklyCrucible',
        'kingsfall'               => 'KingsFall',
        'vaultofglass'            => 'VaultOfGlass',
        'crota'                   => 'Crota',
        'nightfall'               => 'Nightfall',
        'heroicstrike'            => 'HeroicStrike',
        //'dailychapter'            => 'DailyChapter',
        //'dailycrucible'           => 'DailyCrucible',
        'prisonofelders-playlist' => 'PrisonOfEldersPlaylist',
        'ironbanner'              => 'IronBanner',
        'xur'                     => 'Xur',
        'srl'                     => 'Srl',
        'wrathofthemachine'       => 'WrathOfTheMachine',
        'weeklystory'             => 'WeeklyStory',
        'weeklyfeaturedraid'      => 'WeeklyFeaturedRaid',
    ];

    public function __construct(Advisors $account, array $items = [])
    {
        foreach ($items as $key => $properties) {
            if (!isset($this->lookup[$key])) {
                if (\App::isLocal()) {
                    throw new \Exception('Unknown identifier - '.$key);
                }
                continue;
            }

            $class = 'Destiny\\AdvisorsTwo\\Activity\\'.$this->lookup[$key];

            /** @var Activity $activity */
            $activity = new $class($items, $properties);
            $items[$activity->identifier] = $activity;
        }

        parent::__construct($items);
    }
}
