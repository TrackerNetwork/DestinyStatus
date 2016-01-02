<?php
/**
 * @var \Destiny\Character $character
 */
?>

<div class="plate" style="background-image: url(<?= bungie($character->backgroundPath) ?>);">
	<img class="emblem" src="<?= bungie($character->emblemPath) ?>">
	<div class="details">
		<div class="class"><?= e($character->class) ?></div>
		<div class="race"><?= e($character->raceGender) ?></div>
		<div class="level"><?= e($character->characterLevel) ?></div>
		<div class="light"><?= e($character->lightLevel) ?></div>
	</div>

	<div class="stats">
		<div class="level" title="Level">@include('block/progress', ['progress' => $character->percentToNextLevel, 'label' => $character->percentLabel])</div>
		<div class="level prestige" title="Next Mote of Light">@include('block/progress', ['progress' => $character->prestige->percentToNextLevel, 'label' => $character->prestige->percentLabel])</div>
	</div>

</div>
