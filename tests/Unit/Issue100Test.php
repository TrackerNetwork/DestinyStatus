<?php

namespace Tests\Unit;

use App\Helpers\StringHelper;
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
        $this->assertEquals(StringHelper::bungieSlug($xorth), 'ht%20xorth');

        $ibot = 'iBot';
        $this->assertEquals(StringHelper::bungieSlug($ibot), 'ibot');
    }
}
