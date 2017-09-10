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

        <?php if($item->damage > 1): ?>
        <?php if($item->damageType > App\Enums\DamageType::None): ?>
        <div class="damage" data-type-id="<?= e($item->damageType) ?>" data-type="<?= e($item->damageTypeName) ?>">
            <div class="icon"><img src="<?= asset($item->damageTypeIcon, !\App::isLocal()) ?>" alt="<?= e($item->damageTypeName) ?>">
            </div>
            <div class="name"><?= e($item->damage) ?></div>
        </div>
        <?php else: ?>
        <div class="defense">
            <i class="fa fa-shield"></i>
            <div class="name"><?= e($item->damage) ?></div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
@endif