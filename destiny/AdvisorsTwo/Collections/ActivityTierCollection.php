<?php namespace Destiny\AdvisorsTwo\Collections;

use Destiny\AdvisorsTwo\Activity;
use Destiny\AdvisorsTwo\ActivityTier;
use Illuminate\Support\Collection;

/**
 * @method ActivityTier offsetGet($key)
 */
class ActivityTierCollection extends Collection
{
	public function __construct(Activity $activity, array $items = [])
	{
		foreach ($items as $properties)
		{
			$activity = new ActivityTier($properties);
			$this->items[] = $activity;
		}
	}
}
