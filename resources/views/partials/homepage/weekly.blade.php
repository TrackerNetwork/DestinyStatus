<?php

/** @var Destiny\Definitions\PublicMilestone[] $milestones */
?>

<div class="activities row">
    <?php foreach ($milestones as $milestone): ?>
        <div class="col-md-4">
            <h3><?= $milestone->milestone->display->name; ?></h3>
            @include('partials.homepage.milestone', ['milestone' => $milestone])
        </div>
    <?php endforeach; ?>
</div>