<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Enums\Console;

class ConsoleHelper
{
    /**
     * @param string $console
     * @return int
     * @throws \Exception
     */
    public static function getIdFromConsoleString(string $console) : int
    {
        switch (strtolower($console)) {
            case 'xbl':
            case 'xbox':
                return Console::Xbox;
            case 'psn':
                return Console::Playstation;
            case 'pc':
                return Console::Blizzard;
            default:
                throw new \Exception('Unknown console: ' . $console);
        }
    }
}