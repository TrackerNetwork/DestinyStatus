<?php
/**
 * @var \Destiny\Character\Activity $activity
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
				Level
				<strong><?= ($activity->activityLevel) ?></strong>
			</span>
		</div>
		@if($activity->isRaid() || $activity->isArena())
		<div class="stats opaque">
			Completions:
			<strong><?= $activity->timesCompleted ?></strong>
		</div>
		@endif
	</div>
</div>
