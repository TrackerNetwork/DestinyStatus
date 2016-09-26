<?php
/**
 * @var \Destiny\Character\Currency $currency
 */
?>

<div class="item" data-toggle="tooltip" title="<?=e($currency->itemName)?>" data-identifier="<?=e($currency->itemIdentifier)?>">
	<div class="icon"></div>
	<div class="value"><?= e($currency->value) ?></div>
</div>
