<?php

namespace Destiny\Definitions;

use Carbon\Carbon;
use Destiny\Activity\ActivityCollection;
use Destiny\Activity\ActivityStat;
use Destiny\Activity\ChallengeCollection;
use Destiny\Activity\ModifierCollection;
use Destiny\Definitions\Manifest\Milestone;
use Destiny\Definitions\Milestone\RewardCategory;
use Destiny\Milestones\MilestoneActivity;
use Destiny\Milestones\MilestonePublicQuest;
use Destiny\Milestones\PublicQuestCollection;
use Destiny\Milestones\RewardCategoryCollection;
use Destiny\Milestones\RewardEntryCollection;

/**
 * Class PublicMilestone.
 *
 * @property string $milestoneHash
 * @property array $availableQuests
 * @property array $values
 * @property array $vendorHashes
 * @property string $startDate
 * @property string $endDate
 * @property-read Milestone $definition
 * @property-read PublicQuestCollection $quests
 * @property-read Carbon $start
 * @property-read Carbon $end
 * @property-read string $icon
 * @property-read string $image
 * @property-read string $activityName
 * @property-read string $activityDescription
 * @property-read string $destinationName
 * @property-read string $activityHash
 * @property-read ModifierCollection $skulls
 * @property-read ActivityCollection $activities
 * @property-read ActivityCollection $variants
 * @property-read ChallengeCollection $challenges
 * @property-read RewardEntryCollection $rewards
 * @property-read RewardCategory $lastWeekRewards
 * @property-read RewardCategory $thisWeekRewards
 * @property-read bool $hasIcon
 */
class PublicMilestone extends Definition
{
    protected $appends = [
    ];

    public function __construct($properties = null)
    {
        $properties['definition'] = manifest()->milestone($properties['milestoneHash']);
        parent::__construct($properties);
    }

    protected function gQuests()
    {
        return new PublicQuestCollection($this->availableQuests ?? []);
    }

    protected function gStart()
    {
        return carbon($this->startDate);
    }

    protected function gEnd()
    {
        return carbon($this->endDate);
    }

    protected function gIcon()
    {
        if ($this->definition->display->hasIcon) {
            return $this->definition->display->icon;
        }

        return $this->getFirstQuest()->questItem->display->icon;
    }

    protected function gHasIcon()
    {
        $definitionIcon = $this->definition->display->hasIcon;
        $questIcon = $this->getFirstQuest()->questItem->display->hasIcon;

        return $definitionIcon || $questIcon;
    }

    protected function gImage()
    {
        $quest = $this->getFirstQuest();

        /** @var MilestoneActivity $activity */
        $activity = $quest->milestoneActivity;

        if (!empty($activity)) {
            $image = $activity->definition->pgcrImage;
            if (!str_contains($image, 'destiny_content')) {
                $image = '/img/destiny_content/pgcr/'.$image;
            }
        }

        if (empty($image)) {
            $image = $this->definition->quests[$quest->questItemHash]['overrideImage'];
        }

        return $image ?? null;
    }

    protected function gActivityName()
    {
        $activity = $this->getMilestoneActivity();

        if (empty($activity)) {
            return $this->definition->display->name;
        }

        return $activity->definition->display->name;
    }

    protected function gActivityHash()
    {
        $activity = $this->getMilestoneActivity();

        if (empty($activity)) {
            return '';
        }

        return $activity->activityHash;
    }

    protected function gActivityDescription()
    {
        $activity = $this->getMilestoneActivity();

        if (empty($activity)) {
            return $this->definition->display->description;
        }

        return $activity->definition->display->description;
    }

    protected function gDestinationName()
    {
        $activity = $this->getMilestoneActivity();

        if (empty($activity)) {
            return '';
        }

        return $activity->definition->destination->display->name;
    }

    protected function gSkulls()
    {
        $activity = $this->getMilestoneActivity();

        if (empty($activity)) {
            return [];
        }

        return $activity->modifiers;
    }

    protected function gRewards()
    {
        return new RewardCategoryCollection($this->definition, $this->getNonMutatedProperty('rewards'));
    }

    protected function gLastWeekRewards()
    {
        return $this->rewards->last();
    }

    protected function gThisWeekRewards()
    {
        return $this->rewards->first();
    }

    protected function gVariants()
    {
        $activity = $this->getMilestoneActivity();

        if (empty($activity)) {
            return new ActivityCollection([]);
        }

        return $activity->activities;
    }

    protected function gChallenges()
    {
        $quest = $this->getFirstQuest();

        if (empty($quest)) {
            return new ChallengeCollection([]);
        }

        return $quest->milestoneChallenges;
    }

    private function getFirstQuest() : MilestonePublicQuest
    {
        return $this->quests->first();
    }

    /**
     * @return MilestoneActivity
     */
    private function getMilestoneActivity()
    {
        $quest = $this->getFirstQuest();

        return $quest->milestoneActivity;
    }
}
