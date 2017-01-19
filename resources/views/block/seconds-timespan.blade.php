<?php
/**
 * @var int $seconds
 */

$duration = duration($seconds / 60, 'minutes,seconds');
$duration['seconds'] = round($duration['seconds'], 2);
?>

<div class="timespan" title="Average Lifespan">
    <div class="hours"><?= $duration['minutes'] ?> <span>minutes</span></div>
    @include('block/progress', ['progress' => floor($duration['seconds']), 'label' => $duration['seconds'].' <span>seconds</span>'])
</div>
