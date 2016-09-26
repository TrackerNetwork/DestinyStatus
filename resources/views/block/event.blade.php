<?php
/**
 * @var \Destiny\AdvisorsTwo\Activity $activity
 */
?>
<div class="advisor type-event panel">
    <h3><?= e($activity->name) ?></h3>
    <?php if ($activity->expirationKnown): ?>
        <div class="expires">
            <?= duration_human($activity->minutesUntilExpiration) ?> left
        </div>
    <?php endif; ?>
</div>
