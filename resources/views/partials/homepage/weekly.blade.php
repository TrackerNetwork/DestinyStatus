<?php

/** @var Destiny\Definitions\PublicMilestone[] $milestones */
?>

<div class="activities arenas row">
    <?php foreach ($milestones as $milestone): ?>
        <div class="col-md-4 arena">
            <h3><?= $milestone->definition->display->name; ?></h3>
            @include('partials.homepage.milestone', ['milestone' => $milestone])
        </div>
    <?php endforeach; ?>
</div>