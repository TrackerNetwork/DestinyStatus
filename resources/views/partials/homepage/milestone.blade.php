<?php

/** @var Destiny\Definitions\PublicMilestone $milestone */
?>
<div class="advisor type-activity panel">
    <div class="image">
        @if ($milestone->image !== null)
            <div class="display"><img src="<?= bungie($milestone->image) ?>"></div>
        @endif
        <div class="icon"><img src="<?= bungie($milestone->icon) ?>"></div>
    </div>
    <h3>
        <span class="name"><?= e($milestone->activityName) ?></span>
        <span class="destination"><?= e($milestone->destinationName) ?></span>
    </h3>
</div>