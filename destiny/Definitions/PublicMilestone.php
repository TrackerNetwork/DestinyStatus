<?php

namespace Destiny\Definitions;

use Carbon\Carbon;
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
 * @property-read Milestone $milestone
 * @property-read PublicQuestCollection $quests
 * @property-read Carbon $start
 * @property-read Carbon $end
 * @property-read string $icon
 * @property-read string $image
 * @property-read string $activityName
 */
class PublicMilestone extends Definition
{
    protected $appends = [
    ];

    public function __construct($properties = null)
    {
        $properties['milestone'] = manifest()->milestone($properties['milestoneHash']);
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
        return $this->milestone->display->icon;
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
            $image = $this->milestone->quests[$quest->questItemHash]['overrideImage'];
        }

        return $image ?? null;
    }

    protected function gActivityName()
    {
        $quest = $this->getFirstQuest();
        $activity = $quest->milestoneActivity;

        if (empty($activity)) {
            return $this->milestone->display->name;
        }

        return $activity->definition->display->name;
    }

    private function getFirstQuest() : MilestonePublicQuest
    {
        return $this->quests->first();
    }
}
