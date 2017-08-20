<?php

namespace Tests\Unit;

use Tests\TestCase;

class Issue70Test extends TestCase
{
    /**
     * A test of unicode.
     *
     * @return void
     */
    public function testSimilarAgentNamesWithSpace()
    {
        $items = [
            [
                'displayName' => 'TestFang',
                'platform'    => 'xbl',
            ],
            [
                'displayName' => 'Test Fang',
                'platform'    => 'xbl',
            ],
        ];

        $playerCollection = new \Destiny\PlayerCollection('testfang', $items);
        $this->assertTrue(count($playerCollection) === 1);

        $this->assertEquals('TestFang', $playerCollection->first()->displayName);

        $playerCollection = new \Destiny\PlayerCollection('Test Fang', $items);
        $this->assertEquals('Test Fang', $playerCollection->first()->displayName);
    }
}
