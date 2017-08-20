<?php

namespace Tests\Feature;

use App\Enums\Console;
use App\Helpers\ConsoleHelper;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConsoleHelperTest extends TestCase
{
    public function testCapitalXbox()
    {
        $this->assertEquals(Console::Xbox, ConsoleHelper::getIdFromConsoleString('XBOX'));
    }

    public function testNormalXbox()
    {
        $this->assertEquals(Console::Xbox, ConsoleHelper::getIdFromConsoleString('xbox'));
    }

    public function testXboxLive()
    {
        $this->assertEquals(Console::Xbox, ConsoleHelper::getIdFromConsoleString('xbl'));
    }

    public function testPlaystation()
    {
        $this->assertEquals(Console::Playstation, ConsoleHelper::getIdFromConsoleString('psn'));
    }

    public function testPc()
    {
        $this->assertEquals(Console::Blizzard, ConsoleHelper::getIdFromConsoleString('pc'));
    }
}
