<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\Console;

class ConsoleHelper
{
    /**
     * @param string $console
     *
     * @throws \Exception
     *
     * @return int
     */
    public static function getIdFromConsoleString(string $console): int
    {
        switch (strtolower($console)) {
            case 'xbl':
            case 'xbox':
                return Console::XBOX;
            case 'psn':
                return Console::PLAYSTATION;
            case 'pc':
                return Console::BLIZZARD;
            case 'steam':
                return Console::STEAM;
            default:
                throw new \Exception('Unknown console: '.$console);
        }
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public static function getConsoleStringFromId(int $id): string
    {
        switch ($id) {
            case Console::XBOX:
                return 'xbl';
            case Console::PLAYSTATION:
                return 'psn';
            case Console::BLIZZARD:
                return 'pc';
            case Console::STEAM:
                return 'steam';
            default:
                return 'Unknown: '.$id;
        }
    }

    /**
     * @param string $console
     *
     * @return string
     */
    public static function getPlatformImage(string $console): string
    {
        return asset('/img/'.$console.'.png', !\App::isLocal());
    }
}
