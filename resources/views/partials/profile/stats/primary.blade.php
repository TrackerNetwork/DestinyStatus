<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pvp */
/** @var Destiny\StatisticsCollection $pve */
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header"><i class="fa fa-crosshairs"></i> Primary Weapon Kills</th>
        <th>PvE</th>
        <th>PvP</th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
    <tr>
        <td class="header">Hand Cannon</td>
        <td><?= $pve->weaponKillsHandCannon->formattedValue ?></td>
        <td><?= $pvp->weaponKillsHandCannon->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Auto Rifle</td>
        <td><?= $pve->weaponKillsAutoRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsAutoRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Scout Rifle</td>
        <td><?= $pve->weaponKillsScoutRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsScoutRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Pulse Rifle</td>
        <td><?= $pve->weaponKillsPulseRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsPulseRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Submachine Gun</td>
        <td><?= $pve->weaponKillsSubmachinegun->formattedValue ?></td>
        <td><?= $pvp->weaponKillsSubmachinegun->formattedValue ?></td>
    </tr>
    </tbody>
</table>