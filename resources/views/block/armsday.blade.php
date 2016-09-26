<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity|\Destiny\AdvisorsTwo\Activity\ArmsDay $activity
 * @var \Destiny\Definitions\InventoryItem $weapon
 */
?>
<div class="advisor type-activity panel">
    <div class="image">
        <div class="display"><img src="<?= bungie($activity->display->image) ?>"></div>
        <div class="tiny-icon"><img src="<?= bungie($activity->display->icon) ?>"></div>
    </div>
    <h3>
        <span class="name"><?= e($activity->display->advisorTypeCategory) ?></span>
        <span class="destination">&nbsp;</span>
    </h3>
    <p>
        <?= e($activity->display->faction->factionDescription); ?>
    </p>
    <div class="rounds">
        @foreach($activity->weapons as $i => $weapon)
            <div class="round">
                <div class="info">
                    <div class="round-number">Weapon <?= ($i + 1); ?></div>
                    <div class="enemy">
                        <?= $weapon->itemName; ?>
                    </div>
                </div>
                <div class="skulls">
                    <div class="skull">
                        <img src="<?= bungie($weapon->icon) ?>" data-toggle="popover" alt="<?= e($weapon->itemName) ?>" title="<?= e($weapon->itemName) ?>" data-content="<?= e($weapon->itemDescription) ?>">
                        <span><?= e($weapon->tierTypeName) ?></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <?php if ($activity->expirationKnown): ?>
    <div class="expires">
        <?= duration_human($activity->minutesUntilExpiration) ?> left
    </div>
    <?php endif; ?>
</div>
