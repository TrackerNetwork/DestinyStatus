<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity|\Destiny\AdvisorsTwo\Activity\Trials $activity
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
    @if (count($activity->winRewards) > 0)
        <div role="tabpanel" class="levels">
            <ul class="nav nav-pills" role="tablist">
                <?php foreach($activity->winRewards as $key => $winRewards): ?>
                    <li class="<?= $key === 5 ? "active" : null; ?>"><a href="#win<?= $key; ?>-rewards" role="tab" data-toggle="tab"><?= $key; ?> Wins</a></li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach($activity->winRewards as $key => $winRewards): ?>
                    <div class="rewards tab-pane <?= $key === 5 ? "active" : null; ?>" role="tabpanel" id="win<?= $key; ?>-rewards">
                        <div class="reward">
                            <?php foreach($winRewards as $reward): ?>
                                <img src="<?= bungie($reward->icon) ?>" data-toggle="popover" alt="<?= e($reward->itemName) ?>" title="<?= e($reward->itemName) ?>" data-content="<?= e($reward->itemDescription) ?>">
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    @endif
    <?php if ($activity->expirationKnown): ?>
    <div class="expires">
        <?= duration_human($activity->minutesUntilExpiration) ?> left
    </div>
    <?php endif; ?>
</div>