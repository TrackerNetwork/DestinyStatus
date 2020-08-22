<?php

namespace Tests\Unit;

use App\Helpers\StringHelper;
use Tests\TestCase;

class Issue106Test extends TestCase
{
    public function testPcSlugging()
    {
        $ibot = 'iBot#11125';
        $this->assertEquals(StringHelper::bungieSlug($ibot), 'ibot%2311125');
    }

    public function testSpaceOnXbox()
    {
        $name = 'EM Vagabond';

        $this->assertEquals(StringHelper::bungieSlug($name), 'em%20vagabond');
    }

    public function testUnderscoreOnPsn()
    {
        $name = 'one_second_kill';

        $this->assertEquals(StringHelper::bungieSlug($name), 'one_second_kill');
    }
}
