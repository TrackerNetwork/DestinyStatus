<?php
/** @var \Destiny\Character\Progression $progression */
?>

<div class="progression-weekly">
	<div class="name"><?=e($progression->label)?></div>

	@include('block/progress', ['progress' => $progression->percentToNextLevel, 'label' => $progression->percentLabel])
</div>
