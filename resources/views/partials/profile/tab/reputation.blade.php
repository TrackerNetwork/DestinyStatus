<?php
/**
 * @var Destiny\Player $player
 * @var Destiny\Profile $profile
 * @var Destiny\Definitions\Components\Character $character
 */

?>
<div class="progressions panel">
    @foreach($profile->characterProgressions as $progression)
        @endforeach
    <i>bugged - <a href="https://github.com/Bungie-net/api/issues/47">#47</a></i>
</div>