<?php

declare(strict_types=1);

namespace Destiny;

use App\Enums\Console;
use App\Helpers\ConsoleHelper;

/**
 * @property string $iconPath
 * @property string $membershipType
 * @property string $membershipId
 * @property string $displayName
 * @property string $platform
 * @property string $platformName
 * @property string $platformIcon
 * @property string $clanName
 * @property string $url
 */
class Player extends Model
{
    protected function gPlatform() : string
    {
        return ConsoleHelper::getConsoleStringFromId((int) $this->membershipType);
    }

    protected function gPlatformName() : string
    {
        switch ($this->membershipType) {
            case Console::Xbox:
                return 'Xbox';
            case Console::Playstation:
                return 'PlayStation';
            case Console::Blizzard:
                return 'PC';
            default:
                return 'Unknown: '.$this->membershipType;
        }
    }

    protected function gPlatformIcon() : string
    {
        return ConsoleHelper::getPlatformImage($this->platform);
    }

    protected function gUrl() : string
    {
        return route('account', ['platform' => $this->platform, 'player' => $this->displayName]);
    }
}
