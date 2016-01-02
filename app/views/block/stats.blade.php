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
				<td><?= $pvp->score->value ?></td>
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
				<td><?= $pvp->bestSingleGameScore->value ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Top Match Kills</td>
				<td><?= $pvp->bestSingleGameKills->value ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Zones Captured</td>
				<td><?= $pvp->zonesCaptured->value ?></td>
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
				<td><?= $pve->publicEventsJoined->value ?></td>
			</tr>
			<tr>
				<td class="header" colspan="2">Public Events Completed</td>
				<td><?= $pve->publicEventsCompleted->value ?></td>
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
				<td><?= $pve->kills->value ?></td>
				<td><?= $pvp->kills->value ?></td>
			</tr>
			<tr>
				<td class="header">Assists</td>
				<td><?= $pve->assists->value ?></td>
				<td><?= $pvp->assists->value ?></td>
			</tr>
			<tr>
				<td class="header">Precision Kills</td>
				<td><?= $pve->precisionKills->value ?></td>
				<td><?= $pvp->precisionKills->value ?></td>
			</tr>
			<tr>
				<td class="header">Deaths</td>
				<td><?= $pve->deaths->value ?></td>
				<td><?= $pvp->deaths->value ?></td>
			</tr>
			<tr>
				<td class="header">Suicides</td>
				<td><?= $pve->suicides->value ?></td>
				<td><?= $pvp->suicides->value ?></td>
			</tr>
			<tr>
				<td class="header">Orbs Created</td>
				<td><?= $pve->orbsDropped->value ?></td>
				<td><?= $pvp->orbsDropped->value ?></td>
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
				<td><?= $pve->weaponKillsSuper->value ?></td>
				<td><?= $pvp->weaponKillsSuper->value ?></td>
			</tr>
			<tr>
				<td class="header">Grenade</td>
				<td><?= $pve->weaponKillsGrenade->value ?></td>
				<td><?= $pvp->weaponKillsGrenade->value ?></td>
			</tr>
			<tr>
				<td class="header">Melee</td>
				<td><?= $pve->weaponKillsMelee->value ?></td>
				<td><?= $pvp->weaponKillsMelee->value ?></td>
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
				<td><?= $pve->weaponKillsHandCannon->value ?></td>
				<td><?= $pvp->weaponKillsHandCannon->value ?></td>
			</tr>
			<tr>
				<td class="header">Auto Rifle</td>
				<td><?= $pve->weaponKillsAutoRifle->value ?></td>
				<td><?= $pvp->weaponKillsAutoRifle->value ?></td>
			</tr>
			<tr>
				<td class="header">Scout Rifle</td>
				<td><?= $pve->weaponKillsScoutRifle->value ?></td>
				<td><?= $pvp->weaponKillsScoutRifle->value ?></td>
			</tr>
			<tr>
				<td class="header">Pulse Rifle</td>
				<td><?= $pve->weaponKillsPulseRifle->value ?></td>
				<td><?= $pvp->weaponKillsPulseRifle->value ?></td>
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
				<td><?= $pve->weaponKillsSideArm->value ?></td>
				<td><?= $pvp->weaponKillsSideArm->value ?></td>
			</tr>
			<tr>
				<td class="header">Fusion Rifle</td>
				<td><?= $pve->weaponKillsFusionRifle->value ?></td>
				<td><?= $pvp->weaponKillsFusionRifle->value ?></td>
			</tr>
			<tr>
				<td class="header">Shotgun</td>
				<td><?= $pve->weaponKillsShotgun->value ?></td>
				<td><?= $pvp->weaponKillsShotgun->value ?></td>
			</tr>
			<tr>
				<td class="header">Sniper</td>
				<td><?= $pve->weaponKillsSniper->value ?></td>
				<td><?= $pvp->weaponKillsSniper->value ?></td>
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
				<td><?= $pve->weaponKillsMachinegun->value ?></td>
				<td><?= $pvp->weaponKillsMachinegun->value ?></td>
			</tr>
			<tr>
				<td class="header">Rocket Launcher</td>
				<td><?= $pve->weaponKillsRocketLauncher->value ?></td>
				<td><?= $pvp->weaponKillsRocketLauncher->value ?></td>
			</tr>
			<tr>
				<td class="header">Sword</td>
				<td><?= $pve->weaponKillsSword->value ?></td>
				<td><?= $pvp->weaponKillsSword->value ?></td>
			</tr>
		</tbody>
	</table>
</div>
