<?php namespace Destiny\Definitions;

use Destiny\Skull;

/**
 * @property string $activityHash
 * @property string $activityName
 * @property string $activityDescription
 * @property string $icon
 * @property string $releaseIcon
 * @property int $releaseTime
 * @property int $activityLevel
 * @property string $completionFlagHash
 * @property float $activityPower
 * @property int $minParty
 * @property int $maxParty
 * @property int $maxPlayers
 * @property string $destinationHash
 * @property string $placeHash
 * @property string $activityTypeHash
 * @property int $tier
 * @property string $pgcrImage
 * @property array $rewards
 * @property \Destiny\Skull[] $skulls
 *
 * @property \Destiny\Definitions\ActivityType $activityType
 * @property \Destiny\Definitions\Place $place
 * @property \Destiny\Definitions\Destination $destination
 */
class Activity extends Definition
{
	protected $appends = [
		'activityType',
		'destination',
		'place',
		'skulls',
	];

	protected function gActivityHash($value)
	{
		return (string) $value;
	}

	protected function gActivityName($value)
	{
		return trim($value);
	}

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

	protected function gSkulls()
	{
		$skulls = $this->newCollection();

		foreach (array_get($this->properties, 'skulls') ?: [] as $properties)
		{
			$skull = new Skull($properties);
			$skulls->put($skull->displayName, $skull);
		}

		return $skulls;
	}
}
