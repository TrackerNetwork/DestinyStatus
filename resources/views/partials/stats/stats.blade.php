<?php
/**
 * @var string $icon
 * @var string $header
 * @var array $stats
 */
?>
<div class="stats panel">
    <table class="table table-condensed table-striped">
        <thead>
        <tr>
            <th class="header" colspan="3"><i class="fa {{ $icon }}"></i> {{ $header }}</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($stats as $stat): ?>
            <tr>
                <td class="header" colspan="2">{{ $stat['name'] }}</td>
                <td>{{ $stat['value'] }}</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>