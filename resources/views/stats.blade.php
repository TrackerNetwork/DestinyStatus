@extends('layout')
@section('title', 'Combined Stats '.$player->displayName)
@section('content')
@include('block/player', ['player' => $player, 'tab' => 'stats'])
<?php
/**
 * @var \Destiny\StatisticsCollection $stats
 * @var \Destiny\Definitions\Activity[] $activityStats
 */
?>

<div class="statistics stats-index row">
    <br />
    <div class="col-sm-12">
        <div class="alert alert-info">
            Combined stats from all characters (present and deleted) merged between PvE and PvP.
        </div>
    </div>
    <div class="col-sm-4">
        <div class="time panel">
            <div class="info">Active Time Played</div>
            @include('block/timespan', ['minutes' => $stats->secondsPlayed->value / 60])
            <div class="info">Average Lifespan</div>
            @include('block/seconds-timespan', ['seconds' => $stats->averageLifespan->value])
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> PvP & PvE</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header" colspan="2">Score</td>
                    <td><?= $stats->score->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Kills</td>
                    <td><?= $stats->kills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Deaths</td>
                    <td><?= $stats->deaths->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Assists</td>
                    <td><?= $stats->assists->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Suicides</td>
                    <td><?= $stats->suicides->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">K/D Ratio</td>
                    <td><?= $stats->killsDeathsRatio->displayValue; ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">KA/D Ratio</td>
                    <td><?= $stats->killsDeathsAssists->displayValue; ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Combat Rating</td>
                    <td><?= $stats->combatRating->displayValue; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> PvP & PvE</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header" colspan="2">Longest Kill Spree</td>
                    <td><?= $stats->longestKillSpree->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Longest Life</td>
                    <td><?= $stats->longestSingleLife->displayValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Top Game Score</td>
                    <td><?= $stats->bestSingleGameScore->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Top Game Kills</td>
                    <td><?= $stats->bestSingleGameKills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Matches Won</td>
                    <td><?php
                        $entered = $stats->activitiesEntered->value ?: 0;
                        $won = $stats->activitiesWon->value ?: 0;
                        $percent = $entered ? ($won / $entered * 100) : 0;

                        echo sprintf("%d/%d (%.2f%%)", $won, $entered, $percent);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Top Weapon Type</td>
                    <td><?= $stats->weaponBestType->displayValue; ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Orbs Dropped</td>
                    <td><?= $stats->orbsDropped->formattedValue; ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Orbs Gathered</td>
                    <td><?= $stats->orbsGathered->formattedValue; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> Other Stats</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header" colspan="2">Rez's Performed</td>
                    <td><?= $stats->resurrectionsPerformed->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Rez's Received</td>
                    <td><?= $stats->resurrectionsReceived->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Max Character Level</td>
                    <td><?= $stats->highestCharacterLevel->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Max Light Level</td>
                    <td><?= $stats->highestLightLevel->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> PvP</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header" colspan="2">Zones Captured</td>
                    <td><?= $stats->zonesCaptured->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Zones Neutralized</td>
                    <td><?= $stats->zonesNeutralized->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Relics Captured</td>
                    <td><?= $stats->relicsCaptured->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Defensive Kills</td>
                    <td><?= $stats->defensiveKills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Offensive Kills</td>
                    <td><?= $stats->offensiveKills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Domination Kills</td>
                    <td><?= $stats->dominationKills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Team Scores (Summed)</td>
                    <td><?= $stats->teamScore->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Participants Scores (Summed)</td>
                    <td><?= $stats->allParticipantsScore->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> Public Events</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header" colspan="2">Public Events Joined</td>
                    <td><?= $stats->publicEventsJoined->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Public Events Completed</td>
                    <td><?= $stats->publicEventsCompleted->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Public Events Cleared</td>
                    <td><?php
                        $entered = $stats->publicEventsJoined->value ?: 0;
                        $cleared = $stats->publicEventsCompleted->value ?: 0;
                        $percent = $entered ? ($cleared / $entered * 100) : 0;

                        echo sprintf("%d/%d (%.2f%%)", $cleared, $entered, $percent);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="header" colspan="2">CoO - Tier 1 Completions</td>
                    <td><?= $stats->courtOfOryxWinsTier1->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">CoO - Tier 2 Completions</td>
                    <td><?= $stats->courtOfOryxWinsTier2->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">CoO - Tier 3 Completions</td>
                    <td><?= $stats->courtOfOryxWinsTier3->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> Kill Stats</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header" colspan="2">Kill Distance (Summed)</td>
                    <td><?= $stats->totalKillDistance->formattedValue ?>m</td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Kill Distance (Average)</td>
                    <td><?= $stats->averageKillDistance->formattedValue ?>m</td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Death Distance (Average)</td>
                    <td><?= $stats->averageDeathDistance->formattedValue ?>m</td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Precision Kills</td>
                    <td><?= $stats->precisionKills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Single Match Precision Kills</td>
                    <td><?= $stats->mostPrecisionKills->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header" colspan="2">Close Calls</td>
                    <td><?= $stats->closeCalls->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-sun-o"></i> Ability Kills</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header">Super</td>
                    <td><?= $stats->weaponKillsSuper->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Grenade</td>
                    <td><?= $stats->weaponKillsGrenade->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Melee</td>
                    <td><?= $stats->weaponKillsMelee->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Relics</td>
                    <td><?= $stats->weaponKillsRelic->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-crosshairs"></i> Primary Weapons Kills</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header">Hand Cannon</td>
                    <td><?= $stats->weaponKillsHandCannon->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Auto Rifle</td>
                    <td><?= $stats->weaponKillsAutoRifle->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Scout Rifle</td>
                    <td><?= $stats->weaponKillsScoutRifle->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Pulse Rifle</td>
                    <td><?= $stats->weaponKillsPulseRifle->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-crosshairs"></i> Special Weapons Kills</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header">Fusion Rifle</td>
                    <td><?= $stats->weaponKillsFusionRifle->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Shotgun</td>
                    <td><?= $stats->weaponKillsShotgun->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Sniper</td>
                    <td><?= $stats->weaponKillsSniper->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Sidearm</td>
                    <td><?= $stats->weaponKillsSideArm->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-crosshairs"></i> Heavy Weapons Kills</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="header">Machinegun</td>
                    <td><?= $stats->weaponKillsMachinegun->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Rocket Launcher</td>
                    <td><?= $stats->weaponKillsRocketLauncher->formattedValue ?></td>
                </tr>
                <tr>
                    <td class="header">Sword</td>
                    <td><?= $stats->weaponKillsSword->formattedValue ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="stats panel">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th class="header" colspan="3"><i class="fa fa-trophy"></i> Raid Completions (Current Chars only)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($activityStats as $activity): ?>
                <tr>
                    <td data-identifier="<?= $activity->activityHash; ?>" class="header" colspan="2"><?= $activity->activityName . " (" . $activity->name . ")" ?></td>
                    <td><?= $activity->completions; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
