<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use Destiny\Definitions\Manifest\Activity;
use Destiny\Definitions\Manifest\Objective;
use Destiny\Model;

/**
 * Class MilestoneChallenge.
 *
 * @property string $objectiveHash
 * @property string $activityHash
 * @property-read Objective $objective
 * @property-read Activity $activity
 */
class MilestoneChallenge extends Model
{
    protected $appends = [
    ];

    public function __construct(array $properties)
    {
        parent::__construct($properties);
    }

    protected function gObjective()
    {
        return manifest()->objective((string) $this->objectiveHash);
    }

    protected function gActivity()
    {
        return manifest()->activity((string) $this->activityHash);
    }
}
