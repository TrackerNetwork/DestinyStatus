<?php

namespace Destiny\Definitions;

use Carbon\Carbon;
use Destiny\Activity\ActivityCollection;
use Destiny\Activity\ChallengeCollection;
use Destiny\Activity\ModifierCollection;
use Destiny\Definitions\Manifest\Milestone;
use Destiny\Milestones\MilestoneActivity;
use Destiny\Milestones\MilestonePublicQuest;
use Destiny\Milestones\PublicQuestCollection;

/**
 * Class PublicMilestone.
 *
 * @property string $milestoneHash
 * @property array $availableQuests
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
 * @property-read ModifierCollection $skulls
 * @property-read ActivityCollection $activities
 * @property-read ChallengeCollection $challenges
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
        return new PublicQuestCollection($this->availableQuests);
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
        return $this->definition->display->icon;
    }

    protected function gImage()
    {
        $quest = $this->getFirstQuest();

        /** @var MilestoneActivity $activity */
        $activity = $quest->milestoneActivity;

        if (!empty($activity)) {
            $image = $activity->definition->pgcrImage;
            $image = '/img/destiny_content/pgcr/'.$image;
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
