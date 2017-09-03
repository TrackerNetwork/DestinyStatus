<?php
/**
 * @var Destiny\Player $player
 * @var App\Account $account
 * @var Destiny\Profile $profile
 */
?>

@extends('layout')
@section('title', $player->displayName)

@section('content')
    @include('partials.profile.player', ['player' => $player, 'account' => $account, 'tab' => 'account'])
    <br />
    <pre>
    </pre>
    @if ($account->stats)
        <div class="statistics row">
            <div class="col-sm-12">
                <h3>Destiny 1 Stats&nbsp;<small>(<a target="_blank" href="https://d1.destinystatus.com/<?= $player->platform; ?>/<?= $account->slug; ?>">view full stats</a>)</small></h3>
            </div>
            <div class="col-sm-3">
                <div class="stats panel">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr>
                            <th class="header" colspan="3"><i class="fa fa-trophy"></i> PvP & PvE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="header" colspan="2">Grimoire</td>
                            <td><?= $account->stats->grimoire; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="stats panel">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr>
                            <th class="header" colspan="3"><i class="fa fa-trophy"></i> PvE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="header" colspan="2">Raid Clears</td>
                            <td><?= $account->stats->raid_completions; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="stats panel">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr>
                            <th class="header" colspan="3"><i class="fa fa-trophy"></i> PvP</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="header" colspan="2">KD Ratio</td>
                            <td><?= $account->stats->kd; ?> (<?= $account->stats->total_games . ' games' ?>)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="stats panel">
                    <div class="time panel">
                        <div class="info">Active Time Played</div>
                        @include('partials.duration', ['minutes' => $account->stats->playtime / 60])
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop