<?php

namespace Destiny\Character;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\ActivityTier;
use Destiny\Character;
use Destiny\Collection;
use Destiny\StatisticsCollection;

/**
 * @property bool $private
 *
 * @method \Destiny\Character\Activity offsetGet($key)
 */
class ActivityCollection extends Collection
{
    /**
     * @var \Destiny\Character
     */
    protected $character;

    /**
     * @var array
     */
    protected $featuredRaids = [
        '856898338' => '4038697181',
        '4000873610' => '2324706853',
        '3978884648' => '1016659723',
        '3356249023' => '430160982',
    ];

    public function __construct(Character $character, array $stats, array $checklist)
    {
        $this->character = $character;
        if (count($checklist) === 0) {
            return;
        }

        $advisors = new Advisors($checklist);

        // stats grouped by activity hash
        $statsArray = [];
        foreach ($stats as $k => $stat) {
            $activityHash = (string) $stat['activityHash'];
            $statsArray[$activityHash] = new StatisticsCollection($stat['values']);

            // temporarily reindex
            $stats[$activityHash] = $stat;
            unset($stats[$k]);
        }

        // Merge non-featured with featured 390LL raids
        foreach ($this->featuredRaids as $featured => $nonFeatured) {
            if (isset($stats[$featured]) && isset($stats[$nonFeatured])) {
                $mergedStats = array_mesh($stats[$featured], $stats[$nonFeatured]);
                $statsArray[$featured] = new StatisticsCollection($mergedStats['values']);
                $statsArray[$nonFeatured] = new StatisticsCollection($mergedStats['values']);
            }
        }

        // Weekly Nightfall
        $nightfall = $advisors->nightfall->toActivity($character, $statsArray);
        $this->put('NIGHTFALL', $nightfall);

        /** @var ActivityTier $activityTier */
        foreach ($advisors->vaultofglass->activityTiers as $activityTier) {
            /** @var ActivityTier $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $activity->activityMode = $activityTier->tierDisplayName;
            $this->put('RAID_'.$activity->activityHash, $activity);
        }

        foreach ($advisors->crota->activityTiers as $activityTier) {
            /** @var Activity $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $activity->activityMode = $activityTier->tierDisplayName;
            $this->put('RAID_'.$activity->activityHash, $activity);
        }

        foreach ($advisors->kingsfall->activityTiers as $activityTier) {
            /** @var Activity $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $activity->activityMode = $activityTier->tierDisplayName;
            $this->put('RAID_'.$activity->activityHash, $activity);
        }

        foreach ($advisors->wrathofthemachine->activityTiers as $activityTier) {
            /** @var Activity $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $activity->activityMode = $activityTier->tierDisplayName;
            $this->put('RAID_'.$activity->activityHash, $activity);
        }

        foreach ($advisors->elderchallenge->activityTiers as $activityTier) {
            /** @var Activity $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $this->put('ARENA_'.$activity->activityHash, $activity);
        }

        foreach ($advisors->prisonofelders->activityTiers as $activityTier) {
            /** @var Activity $activity */
            $activity = $activityTier->toActivity($character, $statsArray);
            $this->put('ARENA_'.$activity->activityHash, $activity);
        }
    }

    protected function gWeekly()
    {
        $items = [];

        foreach ($this as $k => $activity) {
            if ($activity->isWeekly()) {
                $items[$k] = $activity;
            }
        }

        return $items;
    }

    protected function gWeeklyStrikes()
    {
        $items = [];

        foreach ($this as $k => $activity) {
            if ($activity->isWeeklyHeroic() || $activity->isNightfall()) {
                $items[$k] = $activity;
            }
        }

        return $items;
    }

    protected function gDailyAndNightfall()
    {
        $items = [];

        /**
         * @var string
         * @var Activity $activity
         */
        foreach ($this as $k => $activity) {
            if (starts_with($k, 'DAILY') || starts_with($k, 'NIGHTFALL')) {
                $items[$activity->activityHash] = $activity;
            }
        }

        return $items;
    }

    protected function gWeeklyRaids()
    {
        $items = [];

        /**
         * @var string
         * @var Activity $activity
         */
        foreach ($this as $k => $activity) {
            if (starts_with($k, 'RAID')) {
                $items[$activity->activityHash] = $activity;
            }
        }

        return $items;
    }

    protected function gWeeklyArenas()
    {
        $items = [];

        /**
         * @var string
         * @var Activity $activity
         */
        foreach ($this as $k => $activity) {
            if (starts_with($k, 'ARENA')) {
                $items[$activity->activityHash] = $activity;
            }
        }

        return $items;
    }
}
