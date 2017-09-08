<?php

/** @var Destiny\Definitions\PublicMilestone $milestone */
?>
<div class="advisor type-activity panel">
    <div class="image">
        @if ($milestone->image !== null)
            <div class="display"><img src="<?= bungie($milestone->image) ?>"></div>
        @endif
        <div class="icon"><img src="<?= bungie($milestone->icon) ?>"></div>
        <?php if(count($milestone->skulls) > 0): ?>
            <div class="skulls">
                <?php foreach($milestone->skulls as $skull): ?>
                    <img src="<?= bungie($skull->display->icon) ?>" data-toggle="popover"
                         alt="<?= e($skull->display->name) ?>" title="<?= e($skull->display->name) ?>"
                         data-content="<?= e($skull->display->description) ?>" />
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <h3>
        <span class="name"><?= e($milestone->activityName) ?></span>
        <span class="destination"><?= e($milestone->destinationName) ?></span>
    </h3>
</div>