<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity|\Destiny\AdvisorsTwo\Activity\WeeklyCrucible $activity
 */
?>
<?php if ($activity instanceof \Destiny\AdvisorsTwo\Activity\ActivityInterface): ?>
<div class="advisor type-activity panel">
    <div class="image">
        <div class="display"><img src="<?= bungie($activity->image) ?>"></div>
        <div class="icon"><img src="<?= bungie($activity->icon) ?>"></div>
        <?php if(count($activity->skulls) > 0): ?>
            <div class="skulls">
                <?php foreach($activity->skulls as $skull): ?>
                    <img src="<?= bungie($skull->icon) ?>" data-toggle="popover" alt="<?= e($skull->displayName) ?>" title="<?= e($skull->displayName) ?>" data-content="<?= e($skull->description) ?>">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <h3>
        <span class="name"><?= e($activity->activityName) ?></span>
        <span class="destination"><?= e($activity->destinationName) ?></span>

        <?php if ($activity->activityTier->data->displayLevel > 0): ?>
            <span class="panel-heading">
                A Level <strong><?= e($activity->activityTier->data->displayLevel); ?></strong>
                mission recommended at <strong><?= e($activity->activityTier->data->recommendedLight); ?></strong> Light
            </span>
        <?php endif; ?>
    </h3>
    <p>
        <?= e($activity->definition->activityDescription); ?>
    </p>
    @if (count($activity->rewards) > 0)
        <div role="tabpanel" class="rewards levels">
            <ul class="nav nav-pills" role="tablist">
                <li class="active"><a href="#<?= $activity->activityHash; ?>-rewards" role="tab" data-toggle="tab">Rewards</a></li>
            </ul>
            <div class="tab-content">
                <div class="rewards tab-pane active" role="tabpanel" id="#<?= $activity->activityHash; ?>-rewards">
                    <?php foreach($activity->rewards as $reward): ?>
                    <div class="reward">
                        <img src="<?= bungie($reward->icon) ?>">
                        <span class="name"><?= e($reward->itemName) ?></span>
                        <span class="value"><?= e($reward->quantity) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    @endif
    <?php if ($activity->expirationKnown): ?>
    <div class="expires">
        <?= duration_human($activity->minutesUntilExpiration) ?> left
    </div>
    <?php else: ?>
    <div class="expires">
        Recommended light is <strong><?= $activity->activityTier->data->recommendedLight; ?></strong>
    </div>
    <?php endif; ?>
</div>
<?php else: ?>
    <div class="alert alert-info">
        This advisor is gone :(
    </div>
<?php endif; ?>
