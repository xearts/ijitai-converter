<?php
namespace Xearts\ItaijiConverter;

use PHPUnit\Framework\TestCase;

class Iso2022JPConverterTest extends TestCase
{
    /**
     * @param $text
     * @param $expected
     * @dataProvider dataProviderForTextConvert
     */
    public function testConvert($text, $expected)
    {
        $sut = new Iso2022JPConverter();
        $this->assertEquals($expected, $sut->convert($text));
    }

    public function dataProviderForTextConvert()
    {
        return [
            'はしご高は高に' => ['髙林', '高林'],
            '鳥栖は鳥栖のまま' => ['鳥栖', '鳥栖']
        ];
    }
}