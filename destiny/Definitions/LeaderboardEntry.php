<?php

namespace Destiny\Definitions;

use App\Helpers\ConsoleHelper;
use Illuminate\Support\Arr;

/**
 * Class LeaderboardEntry.
 *
 * @property int    $rank
 * @property array  $player
 * @property string $characterId
 * @property mixed  $value
 * @property-read string $displayValue
 * @property-read string $formattedValue
 * @property-read string $platform
 * @property-read string $image
 * @property string $name
 * @property string $url
 */
class LeaderboardEntry extends Definition
{
    protected function gValue()
    {
        return Arr::get($this->properties, 'value.basic.value');
    }

    protected function gDisplayValue()
    {
        return Arr::get($this->properties, 'value.basic.displayValue');
    }

    protected function gFormattedValue()
    {
        return number_format(Arr::get($this->properties, 'value.basic.value'));
    }

    protected function gName()
    {
        return Arr::get($this->properties, 'player.destinyUserInfo.displayName');
    }

    protected function gImage()
    {
        return ConsoleHelper::getPlatformImage($this->platform);
    }

    protected function gPlatform(): string
    {
        return ConsoleHelper::getConsoleStringFromId(Arr::get($this->properties, 'player.destinyUserInfo.membershipType'));
    }

    protected function gUrl()
    {
        $platform = $this->platform;
        $name = url_slug($this->name);

        return route('account', [$platform, $name]);
    }
}
