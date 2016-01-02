<?php
/**
 * @var \Destiny\Advisors\Arena $arena
 * @var \Destiny\Advisors\ArenaRound $round
 * @var \Destiny\Definitions\ScriptedSkull $skull
 */
?>

<div class="panel">
	<div class="display" data-toggle="popover" title="<?= e($arena->activityName) ?>" data-content="<?= e($arena->activity->activityDescription) ?>">
		<img class="background" src="<?= bungie($arena->activity->pgcrImage) ?>">
		<img class="icon" src="<?= bungie($arena->iconPath) ?>" alt="" align="left">
		<h3>
			<?= e($arena->activityName) ?>
			<small>Level <?= $arena->activity->activityLevel ?></small>
		</h3>
	</div>

	<div class="rounds">
		@foreach($arena->rounds as $i => $round)
		<div class="round">
			<div class="info">
				<div class="round-number">Round <?= $round->roundNumber ?></div>
				<div class="enemy"><?= e($round->enemy->raceName) ?></div>
			</div>
			<div class="skulls">
				@foreach($round->skulls as $skull)
				<div class="skull">
					<img src="<?= bungie($skull->iconPath) ?>" data-toggle="popover" alt="<?= e($skull->skullName) ?>" title="<?= e($skull->skullName) ?>" data-content="<?= e($skull->description) ?>">
					<span><?= e($skull->skullName) ?></span>
				</div>
				@endforeach
			</div>
		</div>
		@endforeach

		@if($arena->bossFight)
		<div class="round boss">
			<div class="info">
				<div class="round-number">Boss</div>
				<div class="enemy"><?= e($arena->bossName) ?></div>
			</div>
			<div class="skulls">
				@foreach($arena->bossSkulls as $skull)
				<div class="skull">
					<img src="<?= bungie($skull->iconPath) ?>" data-toggle="popover" alt="<?= e($skull->skullName) ?>" title="<?= e($skull->skullName) ?>" data-content="<?= e($skull->description) ?>">
					<span><?= e($skull->skullName) ?></span>
				</div>
				@endforeach
			</div>
		</div>
		@endif
	</div>
</div>
