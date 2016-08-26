<?php namespace Destiny;

use Destiny\Advisors\ArenaCollection;

/**
 * @property string $nightfallActivityHash
 * @property string $dailyCrucibleHash
 * @property array $heroicStrikeHashes
 * @property array $dailyChapterHashes
 * @property array $weeklyCrucible
 * @property \Carbon\Carbon $nightfallResetDate
 * @property \Carbon\Carbon $heroicStrikeResetDate
 * @property \Carbon\Carbon $dailyChapterResetDate
 * @property \Carbon\Carbon $dailyCrucibleResetDate
 *
 * @property \Destiny\Advisors\Activity $nightfall
 * @property \Destiny\Advisors\Activity $heroic
 * @property \Destiny\Advisors\Activity $daily
 * @property \Destiny\Advisors\Activity $dailyCrucible
 * @property \Destiny\Advisors\Event[] $events
 *
 * @property ArenaCollection $arena
 */
class Advisors extends Model
{
	protected function gNightfallResetDate($value)
	{
		return carbon($value);
	}

	protected function gHeroicStrikeResetDate($value)
	{
		return carbon($value);
	}

	protected function gDailyChapterResetDate($value)
	{
		return carbon($value);
	}

	protected function gDailyCrucibleResetDate($value)
	{
		return carbon($value);
	}

	protected function gNightfall()
	{
		$nightfall = $this->getNonMutatedProperty('nightfall');

		if ($nightfall == null)
		{
			return null;
		}

		$definition = manifest()->activity($nightfall['specificActivityHash']);
		$skulls = manifest()->activity($nightfall['activityBundleHash']);

		$activity = new Advisors\Activity($this, $definition, $this->nightfallResetDate);
		$activity->addLevelRewards($skulls);
		$activity->addActiveSkulls($skulls, $nightfall['tiers'][0]['skullIndexes']);

		return $activity;
	}

	protected function gHeroicStrikeHashes($value)
	{
		return $value ?: [];
	}

	protected function gHeroic()
	{
		if (empty($this->heroicStrikeHashes))
		{
			return null;
		}

		$activity = new Advisors\Activity($this, manifest()->activity($this->heroicStrikeHashes[0]), $this->heroicStrikeResetDate);

		foreach ($this->heroicStrikeHashes as $activityHash)
		{
			$activity->addLevelRewards(manifest()->activity($activityHash));
		}

		return $activity;
	}

	protected function gDailyChapterHashes($value)
	{
		return $value ?: [];
	}

	protected function gDaily()
	{
		if (empty($this->dailyChapterHashes))
		{
			return null;
		}

		$activity = new Advisors\Activity($this, manifest()->activity($this->dailyChapterHashes[0]), $this->dailyChapterResetDate);

		foreach ($this->dailyChapterHashes as $activityHash)
		{
			$activity->addLevelRewards(manifest()->activity($activityHash));
		}

		return $activity;
	}

	protected function gWeeklyCrucible()
	{
		$activityHash = $this->properties['weeklyCrucible'][0]['activityBundleHash'];

		$activity = new Advisors\Activity($this, manifest()->activity($activityHash), $this->nightfallResetDate);
		$activity->addLevelRewards(manifest()->activity($activityHash));

		// set image manually to remove placeholder
		$activity->pgcrImage = $this->properties['weeklyCrucible'][0]['image'];

		return $activity;
	}

	protected function gDailyCrucible()
	{
		$activity = new Advisors\Activity($this, manifest()->activity($this->dailyCrucibleHash), $this->dailyCrucibleResetDate);
		$activity->addLevelRewards(manifest()->activity($this->dailyCrucibleHash));

		// set image manually to remove placeholder
		$activity->pgcrImage = $this->properties['dailyCrucible']['image'];

		return $activity;
	}

	protected function gArenas()
	{
		return new ArenaCollection($this->properties['arena']);
	}

	protected function gEvents()
	{
		$collection = $this->newCollection();

		foreach ($this->properties['events']['events'] as $event)
		{
			$hash = (string) $event['eventHash'];
			$event = new Advisors\Event($event);

			if ($event->isActive())
			{
				$collection->put($hash, $event);
			}
		}

		return $collection;
	}
}
