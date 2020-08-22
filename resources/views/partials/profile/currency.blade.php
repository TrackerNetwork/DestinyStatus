<?php
/**
 * @var Destiny\Definitions\Components\Inventory $currency
 */
?>

<div class="item" data-toggle="popover" title="<?= e($currency->definition->display->name)?>"
     data-identifier="<?=e($currency->itemHash)?>"
     data-content="<?= e($currency->definition->display->description); ?>">
    <div class="icon"><img src="@bungie($currency->definition->display->icon)" /></div>
    <div class="value">@n($currency->quantity)</div>
</div>