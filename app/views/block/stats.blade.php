<?php
/**
 * @var \Destiny\Character\Statistics $stats
 */

/** @var \Destiny\StatisticsCollection $total */
$total = $stats->total;
/** @var \Destiny\StatisticsCollection $pve */
$pve   = $stats->pve;
/** @var \Destiny\StatisticsCollection $pvp */
$pvp   = $stats->pvp;

?>

<div class="stats panel"><?php $key = 'stats-pvp-'.$stats->character->characterId; ?>
	<table class="table table-condensed table-striped">
		<thead>
			<tr>
				<th class="header" colspan="3"><i class="fa fa-trophy"></i> PvP</th>
			</tr>
		</thead>
		<tbody id="<?= $key ?>">
			<tr>
				<td class="header" colspan="2">Score</td>
				<td><?= $pvp->score->formattedValue ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">K/D Ratio</td>
				<td><?php
					$kills = $pvp->kills->value ?: 0;
					$deaths = $pvp->deaths->value ?: 0;
					$ratio = $deaths ? ($kills / $deaths) : $kills;

					echo sprintf("%.2f", $ratio);
				?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Longest Kill Spree</td>
				<td><?= $pvp->longestKillSpree->value ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Longest Life</td>
				<td><?= $pvp->longestSingleLife->displayValue ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Top Match Score</td>
				<td><?= $pvp->bestSingleGameScore->formattedValue ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Top Match Kills</td>
				<td><?= $pvp->bestSingleGameKills->value ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Zones Captured</td>
				<td><?= $pvp->zonesCaptured->formattedValue ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Matches Won</td>
				<td><?php
					$entered = $pvp->activitiesEntered->value ?: 0;
					$won = $pvp->activitiesWon->value ?: 0;
					$percent = $entered ? ($won / $entered * 100) : 0;

					echo sprintf("%d/%d (%.2f%%)", $won, $entered, $percent);
				?></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="stats panel"><?php $key = 'stats-pve-'.$stats->character->characterId; ?>
	<table class="table table-condensed table-striped">
		<thead>
			<tr>
				<th class="header" colspan="3"><i class="fa fa-gamepad"></i> PvE</th>
			</tr>
		</thead>
		<tbody id="<?= $key ?>">
			<tr>
				<td class="header" colspan="2">Public Events Joined</td>
				<td><?= $pve->publicEventsJoined->formattedValue ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Public Events Completed</td>
				<td><?= $pve->publicEventsCompleted->formattedValue ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Activities Cleared</td>
				<td><?php
					$entered = $pve->activitiesEntered->value ?: 0;
					$cleared = $pve->activitiesCleared->value ?: 0;
					$percent = $entered ? ($cleared / $entered * 100) : 0;

					echo sprintf("%d/%d (%.2f%%)", $cleared, $entered, $percent);
				?></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="stats panel"><?php $key = 'stats-totals-'.$stats->character->characterId; ?>
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
				<td><?= duration_human($pve->secondsPlayed->value / 60, 'hours,minutes', true, ' ') ?></td>
				<td><?= duration_human($pvp->secondsPlayed->value / 60, 'hours,minutes', true, ' ') ?></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="stats panel"><?php $key = 'stats-abilities-'.$stats->character->characterId; ?>
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
</div>

<div class="stats panel"><?php $key = 'stats-weapons-'.$stats->character->characterId; ?>
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
		</tbody>
	</table>
</div>

<div class="stats panel"><?php $key = 'stats-weapons-'.$stats->character->characterId; ?>
	<table class="table table-condensed table-striped">
		<thead>
			<tr>
				<th class="header"><i class="fa fa-crosshairs"></i> Special Weapon Kills</th>
				<th>PvE</th>
				<th>PvP</th>
			</tr>
		</thead>
		<tbody id="<?= $key ?>">
			<tr>
				<td class="header">Sidearm</td>
				<td><?= $pve->weaponKillsSideArm->formattedValue ?></td>
				<td><?= $pvp->weaponKillsSideArm->formattedValue ?></td>
			</tr>
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
		</tbody>
	</table>
</div>

<div class="stats panel"><?php $key = 'stats-weapons-'.$stats->character->characterId; ?>
	<table class="table table-condensed table-striped">
		<thead>
			<tr>
				<th class="header"><i class="fa fa-crosshairs"></i> Heavy Weapon Kills</th>
				<th>PvE</th>
				<th>PvP</th>
			</tr>
		</thead>
		<tbody id="<?= $key ?>">
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
</div>
