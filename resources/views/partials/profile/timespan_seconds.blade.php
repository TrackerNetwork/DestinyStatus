<?php
/**
 * @var int $minutes
 */
$duration = duration($minutes, 'hours,minutes,seconds');
?>

<div class="timespan" title="Total playtime">
    <div class="hours"><?= $duration['hours'] ?> <span>hours</span></div>
    @include('partials.progress', ['progress' => floor($duration['minutes'] / 60 * 100), 'label' => $duration['minutes'].' <span>minutes </span>' . $duration['seconds'] . ' <span>seconds</span>'])
</div>