<?php
/**
 * @var \Destiny\Character\Activity $activity
 * @var \Destiny\Character $character
 */
?>

<div class="activity" data-hash="<?= $activity->activityHash ?>" data-identifier="<?= $activity->identifier ?>" data-completed="<?= bool($activity->isCompleted) ?>">
	<div class="image">
		<img class="icon" src="<?= bungie($activity->icon) ?>">
	</div>
	<div class="activity-details">
		<div class="name">
			<?= e($activity->activityName) ?>
			@if($activity->isCompleted)<i class="fa fa-check"></i>@endif
		</div>
		<div class="level">
			<span class="label">
				<?php if ($activity->activityLevel > 1): ?>
					<?php if ($activity->isRaid()): ?>
						<strong><?= ($activity->activityMode) ?></strong> Mode
					<?php else: ?>
						Level
						<strong><?= ($activity->activityLevel) ?></strong>
					<?php endif; ?>
				<?php else: ?>
					PVP
				<?php endif; ?>
			</span>
		</div>
		@if (($activity->isRaid() || $activity->isArena()) && $character->hasStats())
			<div class="stats opaque">
				Completions:
				<strong><?= $activity->timesCompleted ?></strong>
			</div>
		@endif
	</div>
</div>