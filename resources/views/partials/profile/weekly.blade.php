<?php
/** @var Destiny\Definitions\Components\Inventory $item */
?>

<div class="progression-weekly">
    <div class="name"><?= e($item->definition->display->name)?></div>

    @include('partials.progress', ['progress' => $item->percentToNextLevel, 'label' => $item->percentLabel])
</div>