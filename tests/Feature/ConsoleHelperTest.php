<?php

namespace Tests\Feature;

use App\Enums\Console;
use App\Helpers\ConsoleHelper;
use Tests\TestCase;

class ConsoleHelperTest extends TestCase
{
    public function testCapitalXbox()
    {
        $this->assertEquals(Console::XBOX, ConsoleHelper::getIdFromConsoleString('XBOX'));
    }

    public function testNormalXbox()
    {
        $this->assertEquals(Console::XBOX, ConsoleHelper::getIdFromConsoleString('xbox'));
    }

    public function testXboxLive()
    {
        $this->assertEquals(Console::XBOX, ConsoleHelper::getIdFromConsoleString('xbl'));
    }

    public function testPlaystation()
    {
        $this->assertEquals(Console::PLAYSTATION, ConsoleHelper::getIdFromConsoleString('psn'));
    }

    public function testPc()
    {
        $this->assertEquals(Console::BLIZZARD, ConsoleHelper::getIdFromConsoleString('pc'));
    }
}
