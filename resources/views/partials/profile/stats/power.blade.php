<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pvp */
/** @var Destiny\StatisticsCollection $pve */
xdebug_break();
$foo = "";
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header"><i class="fa fa-crosshairs"></i> Power Kills</th>
        <th>PvE</th>
        <th>PvP</th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
    <tr>
        <td class="header">Fusion Rifle</td>
        <td><?= $pve->weaponKillsFusionRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsFusionRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Shotgun</td>
        <td><?= $pve->weaponKillsShotgun->formattedValue ?></td>
        <td><?= $pvp->weaponKillsShotgun->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Sniper</td>
        <td><?= $pve->weaponKillsSniper->formattedValue ?></td>
        <td><?= $pvp->weaponKillsSniper->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Machinegun</td>
        <td><?= $pve->weaponKillsMachinegun->formattedValue ?></td>
        <td><?= $pvp->weaponKillsMachinegun->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Rocket Launcher</td>
        <td><?= $pve->weaponKillsRocketLauncher->formattedValue ?></td>
        <td><?= $pvp->weaponKillsRocketLauncher->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Sword</td>
        <td><?= $pve->weaponKillsSword->formattedValue ?></td>
        <td><?= $pvp->weaponKillsSword->formattedValue ?></td>
    </tr>
    </tbody>
</table>