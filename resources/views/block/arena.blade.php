<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity\PrisonOfElders|\Destiny\AdvisorsTwo\Activity\ElderChallenge $activity
 * @var \Destiny\AdvisorsTwo\ActivityTier $arena
 * @var \Destiny\Advisors\ArenaRound $round
 * @var \Destiny\Definitions\SkullModifier $skull
 * @var bool $challenge
 */
?>

<div class="advisor type-arena panel">
	@if ($challenge)
		<div class="image">
			<div class="display"><img src="<?= bungie($arena->activity->pgcrImage) ?>"></div>
			<div class="icon"><img src="<?= bungie($arena->iconPath) ?>"></div>
			<?php if(count($activity->skulls) > 0): ?>
				<div class="skulls">
					<?php foreach($activity->skulls as $skull): ?>
						<img src="<?= bungie($skull->icon) ?>" data-toggle="popover" alt="<?= e($skull->displayName) ?>" title="<?= e($skull->displayName) ?>" data-content="<?= e($skull->description) ?>">
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<h3>
			<span class="name"><?= e($arena->activityName) ?></span>
		</h3>
	@else
		<div class="display" data-toggle="popover" title="<?= e($arena->activityName) ?>" data-content="<?= e($arena->activity->activityDescription) ?>">
			<img class="background" src="<?= bungie($arena->activity->pgcrImage) ?>">
			<img class="icon" src="<?= bungie($arena->iconPath) ?>" alt="" align="left">
			<h3>
				<?= e($arena->activityName) ?>
				<small>Level <?= $arena->activity->activityLevel ?></small>
			</h3>
		</div>
	@endif
	<div class="rounds">
		@foreach($arena->rounds as $i => $round)
			<div class="round">
				<div class="info">
					<div class="round-number">Round <?= $round->roundNumber . ($challenge ? " - " . e($round->enemy->raceName) : null) ?></div>
					<div class="enemy">
						@if ($challenge)
							<?= e($round->boss->combatantName); ?>
							<div class="pull-right round-number">
								<span data-toggle="popover" title="<?= e($round->boss->displayName) ?>" data-content="<?= e($round->boss->description) ?>">
									Light <?= $round->bossLightLevel; ?>
								</span>
							</div>
						@else
							<?= e($round->enemy->raceName) ?>
						@endif
					</div>
				</div>
				<div class="skulls">
					@foreach($round->skulls as $skull)
						<div class="skull">
							<img src="<?= bungie($skull->icon) ?>" data-toggle="popover" alt="<?= e($skull->displayName) ?>" title="<?= e($skull->displayName) ?>" data-content="<?= e($skull->description) ?>">
							<span><?= e($skull->displayName) ?></span>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
    @if (count($arena->rewards) > 0)
	<div role="tabpanel" class="rewards levels">
		<ul class="nav nav-pills" role="tablist">
			<li class="active"><a href="#<?= $arena->activityHash; ?>-rewards" role="tab" data-toggle="tab">Rewards</a></li>
		</ul>
		<div class="tab-content">
			<div class="rewards tab-pane active" role="tabpanel" id="#<?= $arena->activityHash; ?>-rewards">
				<?php foreach($arena->rewards as $reward): ?>
					<div class="reward">
						<img src="<?= bungie($reward->icon) ?>">
						<span class="name"><?= e($reward->itemName) ?></span>
						<span class="value"><?= e($reward->quantity) ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
    @endif
	@if (count($arena->objectives) > 0)
	<div role="tabpanel" class="rewards levels">
		<ul class="nav nav-pills" role="tablist">
			<li class="active"><a href="#<?= $arena->activityHash; ?>-objectives" role="tab" data-toggle="tab">Objectives</a></li>
		</ul>
		<div class="tab-content">
			<div class="rewards tab-pane active" role="tabpanel" id="#<?= $arena->activityHash; ?>-objectives">
				<?php foreach($arena->objectives as $objective): ?>
					<div class="reward">
						<span class="name"><?= e($objective->displayDescription) ?></span>
						<span class="value">- <?= e($objective->value) ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	@endif
	<div class="expires">
		Recommended light is <strong><?= $arena->data->recommendedLight; ?></strong>
	</div>
</div>
