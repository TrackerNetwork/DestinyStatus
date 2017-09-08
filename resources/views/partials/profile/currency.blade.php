<?php
/**
 * @var Destiny\Definitions\Components\Inventory $currency
 */
?>

<div class="item" data-toggle="tooltip" title="<?= e($currency->definition->display->name)?>" data-identifier="<?=e($currency->itemHash)?>">
    <div class="icon"><img src="<?= bungie($currency->definition->display->icon)?>" /></div>
    <div class="value"><?= n($currency->quantity) ?></div>
</div>