<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 * @var int $i
 */

$inventory = $character->inventory;

?>
<div class="character col-sm-4"
     data-membership-type="<?= $player->membershipType ?>"
     data-membership-id="<?= $player->membershipId ?>"
     data-character-id="<?= $character->characterId ?>"
>
    @include('partials.profile.plate', ['character' => $character])
    <div role="tabpanel">
        <ul class="nav nav-pills nav-justified" role="tablist">
            <li class="active"><a href="#inventory-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Items</a></li>
            <li><a href="#progressions-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Reputation</a></li>
            <li><a href="#weekly-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Checklist</a></li>
            <li><a href="#stats-<?=$i?>" role="tab" data-toggle="tab" data-group="<?=$i?>">Stats</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="inventory tab-pane active" role="tabpanel" id="inventory-<?=$i?>">
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
        </div>
        <div class="tab-pane" role="tabpanel" id="progressions-<?=$i?>">
            <div class="progressions panel">
                <i>under construction</i>
            </div>
        </div>

        <div class="tab-pane" role="tabpanel" id="weekly-<?=$i?>">
            <div class="panel-heading">
                <?= duration_human(next_weekly()->diffInMinutes()) ?> until reset
            </div>
        </div>

        <div class="statistics tab-pane" role="tabpanel" id="stats-<?=$i?>">
            <div class="progressions panel">
                <i>under construction</i>
            </div>
        </div>
    </div>
</div>