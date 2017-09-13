<?php
/** @var Destiny\Definitions\Leaderboard $category */

$key = 'clan-'.$category->statId;
?>
<table class="table table-condensed table-striped">
    <thead>
    <tr>
        <th class="header"><i class="fa fa-trophy"></i></th>
        <th>Guardian</th>
        <th><?= $category->statName ?></th>
    </tr>
    </thead>
    <tbody id="<?= $key ?>">
        <?php $i = 1; foreach ($category->rankings as $place): ?>
            <tr>
                <td class="header"><?= $i++ ?></td>
                <td><?= $place->name; ?></td>
                <td><?= $place->displayValue; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>