<?php
/**
 * @var \Destiny\Advisors\Activity|\Destiny\Advisors\Event $advisor
 */

if ($advisor instanceof \Destiny\Advisors\Activity): $id = 'activity-'.$advisor->activityHash; ?>

<div class="advisor type-activity panel">
	<div class="image">
		<div class="display"><img src="<?= bungie($advisor->pgcrImage) ?>"></div>

		<div class="icon"><img src="<?= bungie($advisor->icon) ?>"></div>

		<?php if($advisor->skulls->count()): ?>
		<div class="skulls">
			<?php foreach($advisor->skulls as $skull): ?>
			<img src="<?= bungie($skull->icon) ?>" data-toggle="popover" alt="<?= e($skull->displayName) ?>" title="<?= e($skull->displayName) ?>" data-content="<?= e($skull->description) ?>">
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>

	<h3>
		<span class="name"><?= e($advisor->activityName) ?></span>
		<span class="destination"><?= e($advisor->destination->destinationName) ?></span>
	</h3>

	<p class="description"><?= e($advisor->activityDescription) ?></p>

	<div role="tabpanel" class="rewards levels">
		<ul class="nav nav-pills" role="tablist">
			<?php $i = 0; foreach($advisor->rewards as $activity): $i++; ?>
			<li class="<?= ($i == 1 ? 'active' : '') ?>"><a href="#<?= $id . $i ?>" role="tab" data-toggle="tab">Level <?= $activity->level ?></a></li>
			<?php endforeach; ?>
		</ul>

		<div class="tab-content">
			<?php $i = 0; foreach($advisor->rewards as $activity): $i++; ?>
			<div class="rewards tab-pane <?= ($i == 1 ? 'active' : '') ?>" role="tabpanel" id="<?= $id . $i ?>">
				<?php foreach($activity->rewards as $reward): ?>
					<div class="reward">
						<img src="<?= bungie($reward->icon) ?>">
						<span class="name"><?= e($reward->itemName) ?></span>
						<span class="value"><?= e($reward->quantity) ?></span>
					</div>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="expires">
		<?php if ($advisor->resetDate->isPast()): ?>
			This activity has expired
		<?php else: ?>
			<?= duration_human($advisor->minutesUntilReset) ?> left
		<?php endif; ?>
	</div>
</div>

<?php elseif ($advisor instanceof \Destiny\Advisors\Event): ?>

<div class="advisor type-event panel">
	<h3><?= e($advisor->title) ?></h3>

	<?php if($advisor->expirationKnown): ?>
	<div class="expires">
		<?= duration_human($advisor->minutesUntilExpiration) ?> left
	</div>
	<?php endif; ?>
</div>

<?php endif;
