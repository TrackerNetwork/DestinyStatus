<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pve */
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header" colspan="3"><i class="fa fa-gamepad"></i> PvE</th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
    <tr>
        <td class="header" colspan="2">Public Events Completed</td>
        <td><?= $pve->publicEventsCompleted->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header" colspan="2">Activities Cleared</td>
        <td>
            <?php
            $entered = $pve->activitiesEntered->value ?: 0;
            $cleared = $pve->activitiesCleared->value ?: 0;
            $percent = $entered ? ($cleared / $entered * 100) : 0;
            echo sprintf("%d/%d (%.2f%%)", $cleared, $entered, $percent);
            ?>
        </td>
    </tr>
    </tbody>
</table>