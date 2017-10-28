<?php

namespace Tests\Unit;

use Tests\TestCase;

class Issue106Test extends TestCase
{
    public function testPcSlugging()
    {
        $ibot = 'iBot#11125';
        $this->assertEquals(bungie_slug($ibot), 'ibot%2311125');
    }

    public function testSpaceOnXbox()
    {
        $name = 'EM Vagabond';

        $this->assertEquals(bungie_slug($name), 'em%20vagabond');
    }

    public function testUnderscoreOnPsn()
    {
        $name = 'one_second_kill';

        $this->assertEquals(bungie_slug($name), 'one_second_kill');
    }
}
