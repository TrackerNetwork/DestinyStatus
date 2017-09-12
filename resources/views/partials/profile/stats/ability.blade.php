<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pvp */
/** @var Destiny\StatisticsCollection $pve */
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header"><i class="fa fa-sun-o"></i> Ability Kills</th>
        <th>PvE</th>
        <th>PvP</th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
    <tr>
        <td class="header">Super</td>
        <td><?= $pve->weaponKillsSuper->formattedValue ?></td>
        <td><?= $pvp->weaponKillsSuper->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Grenade</td>
        <td><?= $pve->weaponKillsGrenade->formattedValue ?></td>
        <td><?= $pvp->weaponKillsGrenade->formattedValue ?></td>
    </tr>
    <tr>
        <td class="header">Melee</td>
        <td><?= $pve->weaponKillsMelee->formattedValue ?></td>
        <td><?= $pvp->weaponKillsMelee->formattedValue ?></td>
    </tr>
    </tbody>
</table>