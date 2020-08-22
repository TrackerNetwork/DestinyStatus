<?php
/**
 * @var Destiny\Definitions\Progression\Progression $progression
 */
?>

@if (isset($progression))

    <div class="progression" data-toggle="popover"
         title="<?= e($progression->name) ?>"
         data-content="<?= e($progression->description) ?>" >
        <img src="@bungie($progression->icon)" alt="<?= e($progression->name) ?>">
        <div class="name"><?= e($progression->name) ?></div>
        <div class="rank">Rank <span><?= e($progression->level) ?></span></div>

        @include('partials.progress', ['progress' => $progression->percentToNextLevel, 'label' => $progression->percentLabel])
    </div>
@endif