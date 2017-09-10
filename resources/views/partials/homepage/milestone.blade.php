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
    <p>
        <?= e($milestone->activityDescription); ?>
    </p>
    <div role="tabpanel" class="rewards levels">
        <ul class="nav nav-pills" role="tablist">
            <?php if (! $milestone->variants->isEmpty()): ?>
                <li class="active"><a href="#<?= $milestone->milestoneHash; ?>-variants" role="tab" data-toggle="tab" data-group="<?= $milestone->milestoneHash; ?>">Variants</a></li>
            <?php endif; ?>
            <?php if (! $milestone->challenges->isEmpty()): ?>
                <li class=""><a href="#<?= $milestone->milestoneHash; ?>-challenges" role="tab" data-toggle="tab" data-group="<?= $milestone->milestoneHash; ?>">Challenges</a></li>
            <?php endif; ?>
        </ul>
        <div class="tab-content">
            <?php if (! $milestone->variants->isEmpty()): ?>
                <div class="rewards tab-pane active" role="tabpanel" id="<?= $milestone->milestoneHash; ?>-variants">
                    <div class="rounds">
                        <?php foreach($milestone->variants as $variant): ?>
                            <div class="round">
                                <div class="info">
                                    <div class="round-number"><?= $variant->humanMode; ?></div>
                                    <div class="enemy">Level <?= $variant->activityLevel; ?> (Power <?= $variant->activityLightLevel; ?>)</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (! $milestone->challenges->isEmpty()): ?>
                <div class="rewards tab-pane" role="tabpanel" id="<?= $milestone->milestoneHash; ?>-challenges">
                    <div class="rounds">
                        <?php foreach($milestone->challenges as $challenge): ?>
                        <div class="round">
                            <div class="info">
                                <div class="round-number"><?= $challenge->objective->display->name; ?></div>
                                <div class="enemy"><?= $challenge->objective->display->description; ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>