<?php

class Issue32Test extends TestCase
{
    /**
     * A test of unicode
     *
     * @return void
     */
    public function testUnicodeDuringSlugging()
    {
		$ir = 'Ir Yût, the Deathsinger';
		$this->assertEquals('ir-yut-the-deathsinger', slug($ir));

		$alzok = 'Alzok Däl, Gornuk Däl, Zyrok Däl';
		$this->assertEquals('alzok-dal-gornuk-dal-zyrok-dal', slug($alzok));

		$balwur = 'Balwûr';
		$this->assertEquals('balwur', slug($balwur));

		$primus = 'Primus Ta\'aun';
		$this->assertEquals('primus-taaun', slug($primus));
    }
}
