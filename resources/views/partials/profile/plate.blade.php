<?php
/**
 * @var Destiny\Definitions\Components\Character $character
 */
?>

<div class="plate" style="background-image: url(<?= bungie($character->emblemBackgroundPath) ?>);">
    <div class="details">
        <div class="class"><?= e($character->class) ?></div>
        <div class="race"><?= e($character->raceGender) ?></div>
        <div class="level"><?= e($character->baseCharacterLevel) ?></div>
        <div class="light"><?= e($character->light) ?></div>
    </div>

    <div class="stats">
        <div class="stats">
            <div class="level" title="Level">@include('partials.progress', ['progress' => $character->percentToNextLevel, 'label' => $character->percentLabel])</div>
            <div class="level prestige" title="Next Mote of Light">
                @include('partials.progress', ['progress' => 100, 'label' => ''])
            </div>
        </div>
    </div>
</div>