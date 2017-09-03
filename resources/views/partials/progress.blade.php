<?php
/**
 * @var float $progress
 */
?>

<div class="progress" data-complete="<?= boolval($progress == 100) ?>">
    <div class="progress-bar"
         style="width: <?= $progress ?>%;"
         role="progressbar"
         aria-valuenow="<?= $progress ?>"
         aria-valuemin="0"
         aria-valuemax="100">
        <?= $label ?? null ?>
    </div>
</div>