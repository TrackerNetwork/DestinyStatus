<?php

namespace Tests\Unit;

use App\Helpers\StringHelper;
use Tests\TestCase;

class Issue109Test extends TestCase
{
    public function testSluggingOfMultibyteCharacters(): void
    {
        $grame = 'Grëëm#1623';
        $this->assertEquals('grëëm%231623', StringHelper::urlSlug($grame));

        $cburg = 'cbürg#2114';
        $this->assertEquals('cbürg%232114', StringHelper::urlSlug($cburg));
    }
}
