<?php namespace Destiny\Definitions;

/**
 * @property string $activityTypeHash
 * @property string $activityTypeName
 * @property string $activityTypeDescription
 * @property string $identifier
 * @property string $icon
 * @property string $activeBackgroundVirtualPath
 * @property string $completedBackgroundVirtualPath
 * @property string $hiddenOverrideVirtualPath
 * @property string $tooltipBackgroundVirtualPath
 * @property string $enlargedCompletedVirtualPath
 * @property string $enlargedHiddenOverrideVirtualPath
 * @property string $enlargedTooltipBackgroundVirtualPath
 * @property int $order
 */
class ActivityType extends Definition
{
	public function isNightfall()
	{
		return $this->identifier == 'ACTIVITY_TYPE_NIGHTFALL';
	}

	public function isRaid()
	{
		return $this->activityTypeName == 'Raid'
		    || strstr($this->identifier, 'RAID');
	}

	public function isArena()
	{
		return $this->identifier == 'ARENA_CHALLENGE';
	}

	public function isWeeklyHeroic()
	{
		return $this->identifier == 'STRIKE_WEEKLY';
	}

	public function isDaily()
	{
		// cannot be trusted anymore. Daily PVE Events do not have this ActivityType
		return $this->identifier == 'ACTIVITY_TYPE_STORY_FEATURED';
	}

	public function isWeekly()
	{
		return $this->isWeeklyHeroic()
		    || $this->isNightfall()
		    || $this->isRaid()
		    || $this->isArena();
	}
}
