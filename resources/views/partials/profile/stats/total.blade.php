<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pvp */
/** @var Destiny\StatisticsCollection $pve */
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header"><i class="fa fa-star"></i> Totals</th>
        <th>PvE</th>
        <th>PvP</th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
    <tr>
        <td class="header">Kills</td>
        <td><?= $pve->kills->formattedValue ?></td>
        <td><?= $pvp->kills->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Assists</td>
        <td><?= $pve->assists->formattedValue ?></td>
        <td><?= $pvp->assists->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Precision Kills</td>
        <td><?= $pve->precisionKills->formattedValue ?></td>
        <td><?= $pvp->precisionKills->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Deaths</td>
        <td><?= $pve->deaths->formattedValue ?></td>
        <td><?= $pvp->deaths->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Suicides</td>
        <td><?= $pve->suicides->formattedValue ?></td>
        <td><?= $pvp->suicides->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Orbs Created</td>
        <td><?= $pve->orbsDropped->formattedValue ?></td>
        <td><?= $pvp->orbsDropped->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Time Played</td>
        <td><?= duration_human($pve->secondsPlayed->value / 60, 'days,hours,minutes', true, ' ') ?></td>
        <td><?= duration_human($pvp->secondsPlayed->value / 60, 'days,hours,minutes', true, ' ') ?></td>
    </tr>
    </tbody>
</table>