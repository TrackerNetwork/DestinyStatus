<?php
/**
 * @var Destiny\Character\Inventory $inventory
 */
?>
<div class="equipment panel">
    @include('partials.profile.bucket', ['item' => $inventory->subclass])
    @include('partials.profile.bucket', ['item' => $inventory->primaryWeapon])
    @include('partials.profile.bucket', ['item' => $inventory->secondaryWeapon])
    @include('partials.profile.bucket', ['item' => $inventory->heavyWeapon])
    @include('partials.profile.bucket', ['item' => $inventory->ghost])
</div>
<div class="equipment panel">
    @include('partials.profile.bucket', ['item' => $inventory->helmet])
    @include('partials.profile.bucket', ['item' => $inventory->arms])
    @include('partials.profile.bucket', ['item' => $inventory->chest])
    @include('partials.profile.bucket', ['item' => $inventory->boots])
    @include('partials.profile.bucket', ['item' => $inventory->classItem])
</div>
<div class="equipment panel">
    @include('partials.profile.bucket', ['item' => $inventory->emblem])
    @include('partials.profile.bucket', ['item' => $inventory->aura])
    @include('partials.profile.bucket', ['item' => $inventory->sparrow])
    @include('partials.profile.bucket', ['item' => $inventory->ship])
    @include('partials.profile.bucket', ['item' => $inventory->emote])
</div>