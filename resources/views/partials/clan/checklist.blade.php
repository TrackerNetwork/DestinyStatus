<?php
/**
 * @var Destiny\Definitions\Milestone\RewardEntry $reward
 * @var Destiny\Definitions\Item\Quantity $itemReward
 */

$itemReward = $reward->rewards->first();
?>

<div class="activity" data-hash="<?= $reward->rewardEntryHash ?>" data-identifier="<?= $reward->rewardEntryIdentifier ?>" data-completed="@bool($reward->isCompleted)">
    <div class="image">
        <img class="icon" src="@bungie($reward->icon)">
    </div>
    <div class="activity-details">
        <div class="name">
            <?= e($reward->name) ?>
            @if($reward->isCompleted)<i class="fa fa-check"></i>@endif
        </div>
        <div class="level">
            <span class="label">
            </span>
        </div>
        <div class="stats opaque">
            Reward:
            <strong><?= $itemReward->quantity; ?>x <?= $itemReward->item->itemTypeAndTierDisplayName; ?></strong>
        </div>
    </div>
</div>