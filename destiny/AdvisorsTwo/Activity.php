<?php

namespace Destiny\AdvisorsTwo;

use Destiny\Character;
use Destiny\Model;

/**
 * @property string $identifier
 * @property string $vendorHash
 * @property string $name
 * @property bool $expirationKnown
 * @property int $minutesuntilexpiration
 * @property string $image
 * @property string $icon
 * @property Display $display
 * @property Status $status
 * @property \Destiny\Definitions\Activity $definition
 * @property Completion $completion
 */
class Activity extends Model
{
    public function __construct(array $properties)
    {
        $properties['display'] = new Display($properties['display']);

        if (isset($properties['status'])) {
            $properties['status'] = new Status($properties['status']);
        }

        if (isset($properties['completion'])) {
            $properties['completion'] = new Completion($properties['completion']);
        }

        parent::__construct($properties);
    }

    protected function gName()
    {
        return $this->display->advisorTypeCategory;
    }

    protected function gExpirationKnown()
    {
        return $this->status->expirationKnown;
    }

    protected function gMinutesUntilExpiration()
    {
        return $this->status->expirationDate->diffInMinutes();
    }

    protected function gImage()
    {
        return $this->display->image;
    }

    protected function gIcon()
    {
        return $this->display->icon;
    }

    protected function gDestinationName()
    {
        return $this->definition->destination->destinationName;
    }

    protected function gActivityName()
    {
        return $this->definition->activityName;
    }

    protected function gRewards()
    {
        if (isset($this->activity->rewards)) {
            return $this->activity->rewards;
        }
        return $this->activityTier->rewards;
    }

    public function toActivity(Character $character, array $stats)
    {
        $activityHash = $this->definition->activityHash;
        $stat = null;

        if (isset($stats[$activityHash])) {
            $stat = $stats[$activityHash];
        }

        return new Character\Activity($character, $this->definition->toArray(), $stat, $this->completion);
    }
}
