<?php
/**
 * @var \Destiny\Player $player
 * @var string $tab
 * @var \Destiny\Group $group
 */
?>

<div class="clan">
    <h1 class="gamertag">
        <?= e($player->displayName) ?>&nbsp;<small>(<?= e($player->platformName); ?>)</small>
    </h1>
</div>

@include('partials.top_navigation', ['profile' => $player, 'tab' => 'clan'])