<?php
/** @var string $key */
/** @var Destiny\StatisticsCollection $pvp */
?>
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
        <td class="header" colspan="2">Combat Rating</td>
        <td><?= $pvp->combatRating->formattedValue ?></td>
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
        <td class="header" colspan="2">Matches Won</td>
        <td>
            <?php
            $entered = $pvp->activitiesEntered->value ?: 0;
            $won = $pvp->activitiesWon->value ?: 0;
            $percent = $entered ? ($won / $entered * 100) : 0;
            echo sprintf("%d/%d (%.2f%%)", $won, $entered, $percent);
            ?>
        </td>
    </tr>
    <tr>
        <td class="header" colspan="2">Top Weapon Type</td>
        <td><?= $pvp->weaponBestType->displayValue; ?></td>
    </tr>
    </tbody>
</table>