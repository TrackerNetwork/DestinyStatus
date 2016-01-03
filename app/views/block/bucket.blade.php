<?php
/**
 * @var \Destiny\Character\InventoryItem $item
 */
?>

@if($item)
<div class="equipped" data-toggle="tooltip"
	title="<?= e($item->itemDescription) ?>"
	data-complete="<?= bool($item->isGridComplete) ?>"
	data-hash="<?= $item->itemHash ?>"
	>
	<img class="icon" src="<?= bungie($item->icon) ?>">
	<div class="name"><?= e($item->itemName) ?></div>
	<div class="tier"><?= e($item->tierTypeName) ?></div>
	<div class="type opaque"><?= e($item->itemTypeName) ?></div>

	<?php if($item->primaryStat): ?>
		<?php if($item->damage): ?>
		<div class="damage" data-type-id="<?= e($item->damageType) ?>" data-type="<?= e($item->damageTypeName) ?>">
			<div class="icon"><img src="<?= asset($item->damageTypeIcon) ?>" alt="<?= e($item->damageTypeName) ?>"></div>
			<div class="name"><?= e($item->damage) ?></div>
		</div>
		<?php elseif ($item->defense): ?>
		<div class="defense">
			<i class="fa fa-shield"></i>
			<div class="name"><?= e($item->defense) ?></div>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	@include('block/progress', ['progress' => $item->percentToNextLevel, 'label' => $item->progressionLabel])
</div>
@endif
