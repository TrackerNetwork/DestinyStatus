<?php
/**
 * @var \Destiny\Player $player
 * @var string $tab
 * @var \Destiny\Group $group
 */
?>

<div class="clan">
    <h1 class="gamertag">
        <?= e($group->name) ?>&nbsp;<small>(<?= e($group->motto); ?>)</small>
    </h1>
</div>

@include('partials.top_navigation', ['profile' => $player, 'tab' => 'clan'])