<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity|\Destiny\AdvisorsTwo\Activity\IronBanner $activity
 * @var \Destiny\Definitions\InventoryItem $weapon
 */
?>
<div class="advisor-trials type-activity panel">
    <div class="image">
        <div class="display"><img src="<?= bungie($activity->display->image) ?>"></div>
        <div class="tiny-icon"><img src="<?= bungie($activity->display->icon) ?>"></div>
    </div>
    <h3>
        <span class="name"><?= e($activity->display->advisorTypeCategory) ?></span>
        <span class="destination">&nbsp;</span>
    </h3>
    <p>
        <?= $activity->display->tips->random()->message; ?>
    </p>
    <?php if ($activity->expirationKnown): ?>
    <div class="expires">
        <?= duration_human($activity->minutesUntilExpiration) ?> left
    </div>
    <?php endif; ?>
</div>