<?php namespace Destiny\Definitions;

/**
 * @property string $bundleHash
 * @property string $activityName
 * @property string $activityDescription
 * @property string $icon
 * @property string $releaseIcon
 * @property int $releaseTime
 * @property string $destinationHash
 * @property string $placeHash
 * @property string $activityTypeHash
 * @property string[] $activityHashes
 *
 * @property \Destiny\Definitions\ActivityType $activityType
 * @property \Destiny\Definitions\Destination $destination
 * @property \Destiny\Definitions\Place $place
 */
class ActivityBundle extends Definition
{
	protected function gActivityType()
	{
		return manifest()->activityType($this->activityTypeHash);
	}

	protected function gDestination()
	{
		return manifest()->destination($this->destinationHash);
	}

	protected function gPlace()
	{
		return manifest()->place($this->placeHash);
	}
}
