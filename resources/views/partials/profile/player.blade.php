<?php
/**
 * @var \Destiny\Player $player
 * @var \App\Account $account
 * @var string $tab
 */
?>

<div class="player" data-membership-type="<?= $player->membershipType ?>" data-membership-id="<?= $player->membershipId ?>">
    <h1 class="gamertag">
        <?= e($player->displayName) ?>&nbsp;<small>(<?= e($player->platformName); ?>)</small>
    </h1>
    <span class="badges">
        <?= $account->renderBadges(); ?>
    </span>
</div>

@include('partials.top_navigation', ['profile' => $player, 'tab' => 'account'])