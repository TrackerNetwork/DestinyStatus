<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pvp */
/** @var Destiny\StatisticsCollection $pve */
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header"><i class="fa fa-crosshairs"></i> Weapon Kills</th>
        <th>PvE</th>
        <th>PvP</th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
    <tr>
        <td class="header">Auto Rifle</td>
        <td><?= $pve->weaponKillsAutoRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsAutoRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Beam Rifle</td>
        <td><?= $pve->weaponKillsBeamRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsBeamRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Bow</td>
        <td><?= $pve->weaponKillsBow->formattedValue ?></td>
        <td><?= $pvp->weaponKillsBow->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Fusion Rifle</td>
        <td><?= $pve->weaponKillsFusionRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsFusionRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Grenade Launcher</td>
        <td><?= $pve->weaponKillsGrenadeLauncher->formattedValue ?></td>
        <td><?= $pvp->weaponKillsGrenadeLauncher->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Hand Cannon</td>
        <td><?= $pve->weaponKillsHandCannon->formattedValue ?></td>
        <td><?= $pvp->weaponKillsHandCannon->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Trace Rifle</td>
        <td><?= $pve->weaponKillsTraceRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsTraceRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Machine Gun</td>
        <td><?= $pve->weaponKillsMachineGun->formattedValue ?></td>
        <td><?= $pvp->weaponKillsMachineGun->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Pulse Rifle</td>
        <td><?= $pve->weaponKillsPulseRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsPulseRifle->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Rocket Launcher</td>
        <td><?= $pve->weaponKillsRocketLauncher->formattedValue ?></td>
        <td><?= $pvp->weaponKillsRocketLauncher->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Scout Rifle</td>
        <td><?= $pve->weaponKillsScoutRifle->formattedValue ?></td>
        <td><?= $pvp->weaponKillsScoutRifle->formattedValue ?></td>
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
        <td class="header">Submachine Gun</td>
        <td><?= $pve->weaponKillsSubmachinegun->formattedValue ?></td>
        <td><?= $pvp->weaponKillsSubmachinegun->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Sidearms</td>
        <td><?= $pve->weaponKillsSideArm->formattedValue ?></td>
        <td><?= $pvp->weaponKillsSideArm->formattedValue ?></td>
    </tr>
    </tbody>
</table>