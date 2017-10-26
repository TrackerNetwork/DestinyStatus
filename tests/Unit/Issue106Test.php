<?php

namespace Tests\Unit;

use Tests\TestCase;

class Issue106Test extends TestCase
{
    /**
     * A test of unicode.
     *
     * @return void
     */
    public function testSluggingOfSpace()
    {
        $ibot = 'iBot#11125';
        $this->assertEquals(bungie_slug($ibot), 'ibot-11125');
    }
}
