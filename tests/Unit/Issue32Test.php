<?php

namespace Tests\Unit;

use App\Helpers\StringHelper;
use Tests\TestCase;

class Issue32Test extends TestCase
{
    /**
     * A test of unicode.
     *
     * @return void
     */
    public function testUnicodeDuringSlugging()
    {
        $ir = 'Ir Y&#251;t, the Deathsinger';
        $this->assertEquals('ir-yut-the-deathsinger', StringHelper::slug($ir));

        $alzok = 'Alzok D&#228;l, Gornuk D&#228;l, Zyrok D&#228;l';
        $this->assertEquals('alzok-dal-gornuk-dal-zyrok-dal', StringHelper::slug($alzok));

        $balwur = 'Balw&#251;r';
        $this->assertEquals('balwur', StringHelper::slug($balwur));

        $primus = 'Primus Ta&#39;aun';
        $this->assertEquals('primus-taaun', StringHelper::slug($primus));

        $norusk = 'Noru&#39;usk, Servant of Oryx';
        $this->assertEquals('noruusk-servant-of-oryx', StringHelper::slug($norusk));

        $lysanders = 'Lysander&#39;s Cry';
        $this->assertEquals('lysanders-cry', StringHelper::slug($lysanders));
    }
}
