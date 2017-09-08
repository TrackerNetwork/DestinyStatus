<?php
/**
 * @var Destiny\Definitions\Components\Inventory $item
 * @var Destiny\Definitions\Manifest\InventoryItem $definition
 */

$definition = $item->definition ?? null;
?>

@if($item)
    <div class="equipped" data-toggle="tooltip"
         title="<?= e($definition->loreSubtitle) ?>"
         data-complete="<?= boolval($item->isGridComplete) ?>"
         data-hash="<?= $item->hash ?>"
    >
        <img class="icon" src="<?= bungie($definition->itemIcon) ?>">
        <div class="name"><?= e($definition->itemName) ?></div>
        <div class="tier"><?= e($definition->tierName) ?></div>
        <div class="type opaque"><?= e($definition->itemTypeDisplayName) ?></div>

        <?php if($item->primaryStat): ?>
        <?php if($item->damage): ?>
        <div class="damage" data-type-id="<?= e($item->damageType) ?>" data-type="<?= e($item->damageTypeName) ?>">
            <div class="icon"><img src="<?= asset($item->damageTypeIcon) ?>" alt="<?= e($item->damageTypeName) ?>">
            </div>
            <div class="name"><?= e($item->damage) ?></div>
        </div>
        <?php elseif ($item->defense): ?>
        <div class="defense">
            <i class="fa fa-shield"></i>
            <div class="name"><?= e($item->defense) ?></div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
@endif