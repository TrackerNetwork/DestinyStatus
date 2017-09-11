<?php

namespace Tests\Unit;

use Tests\TestCase;

class Issue100Test extends TestCase
{
    /**
     * A test of unicode.
     *
     * @return void
     */
    public function testSluggingOfSpace()
    {
        $xorth = 'HT Xorth';
        $this->assertEquals(bungie_slug($xorth), 'ht%20xorth');

        $ibot = 'iBot';
        $this->assertEquals(bungie_slug($ibot), 'ibot');
    }
}
