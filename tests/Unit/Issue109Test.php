<?php

namespace Tests\Unit;

use Tests\TestCase;

class Issue109Test extends TestCase
{
    /**
     * A test of unicode.
     *
     * @return void
     */
    public function testSluggingOfMultibyteCharacters()
    {
        $grame = 'Grëëm#1623';
        $this->assertEquals('grëëm%231623', url_slug($grame));

        $cburg = 'cbürg#2114';
        $this->assertEquals('cbürg%232114', url_slug($cburg));
    }
}
