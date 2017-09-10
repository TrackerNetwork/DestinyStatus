<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 * @var int $i
 */

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
            @include('partials.profile.tab.items', ['inventory' => $character->inventory])
        </div>
        <div class="tab-pane" role="tabpanel" id="progressions-<?=$i?>">
            @include('partials.profile.tab.reputation', ['progressions' => $character->factions ?? []])
        </div>

        <div class="tab-pane" role="tabpanel" id="weekly-<?=$i?>">
            @include('partials.profile.tab.checklist', ['milestones' => $character->milestones ?? []])
        </div>

        <div class="statistics tab-pane" role="tabpanel" id="stats-<?=$i?>">
            @include('partials.profile.tab.stats')
        </div>
    </div>
</div>