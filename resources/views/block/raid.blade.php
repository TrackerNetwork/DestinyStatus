<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity\KingsFall $activity
 * @var \Destiny\AdvisorsTwo\ActivityTier $activityTier
 * @var \Destiny\Definitions\SkullModifier $skull
 * @var \Destiny\AdvisorsTwo\Reward $reward
 */
?>
<div class="advisor-raid type-activity panel">
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
        <span class="name"><?= e($activity->display->advisorTypeCategory) ?></span>
        <span class="destination"><?= e($activity->display->destination->destinationName) ?></span>
    </h3>
    <p>
        <?= ($activity->definition->activityDescription); ?>
    </p>
    @if (count($activity->activityTiers) > 0)
        <div role="tabpanel" class="rewards levels">
            <ul class="nav nav-pills" role="tablist">
                <li class="active"><a href="#<?= $activity->identifier ?>modes" role="tab" data-toggle="tab" data-group="<?= $activity->identifier; ?>">Modes</a></li>
                <li><a href="#<?= $activity->identifier ?>rewards" role="tab" data-toggle="tab" data-group="<?= $activity->identifier; ?>">Rewards</a></li>
            </ul>
            <div class="tab-content">
                <div class="rewards tab-pane active" role="tabpanel" id="<?= $activity->identifier ?>modes">
                    <div class="rounds">
                        <?php foreach($activity->activityTiers as $activityTier): ?>
                            <?php if (!isset($activityTier->hidden)): ?>
                            <div class="round">
                                <div class="info">
                                    <div class="round-number"><?= $activityTier->tierDisplayName; ?> Mode</div>
                                    <?php if (isset($activityTier->activityData)): ?>
                                        <div class="enemy">Level <strong><?= $activityTier->activityData->displayLevel; ?></strong> (Light <strong><?= $activityTier->activityData->recommendedLight; ?></strong>)</div>
                                    <?php endif; ?>
                                </div>
                                <div class="skulls">
                                    @foreach($activityTier->skulls as $skull)
                                        <div class="skull">
                                            <img src="<?= bungie($skull->icon) ?>" data-toggle="popover" alt="<?= e($skull->displayName) ?>" title="<?= e($skull->displayName) ?>" data-content="<?= e($skull->description) ?>">
                                            <span><?= e($skull->displayName) ?></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="rewards tab-pane" role="tabpanel" id="<?= $activity->identifier ?>rewards">
                    <?php foreach($activity->activityTiers->first()->rewards as $reward): ?>
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
    <?php if (isset($activity->display->tips)): ?>
        <div class="expires">
            <?= $activity->display->tips->random()->message; ?>
        </div>
    <?php endif ?>
</div>
