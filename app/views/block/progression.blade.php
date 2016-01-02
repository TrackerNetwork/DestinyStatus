<?php
/**
 * @var \Destiny\Character\Progression $progression
 */
?>

@if (isset($progression))

<div class="progression">
	<img src="<?= bungie($progression->icon) ?>" alt="">
	<div class="name"><?= e($progression->label) ?></div>
	<div class="rank">Rank <span><?= e($progression->level) ?></span></div>

	@include('block/progress', ['progress' => $progression->percentToNextLevel, 'label' => $progression->percentLabel])
</div>

@endif
