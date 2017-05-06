<?php
namespace Xearts\ItaijiConverter;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class ItaijiConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ItaijiConverter
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new ItaijiConverter;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\Xearts\ItaijiConverter\ItaijiConverter', $actual);
    }


    /**
     * @param string $src
     * @param string $expected
     * @dataProvider convertDataProvider
     */
    public function testConvert($src, $expected)
    {
        $this->assertEquals($expected, $this->skeleton->convert($src));
    }


    public function convertDataProvider()
    {
        return array(
            array('髙林利安', '高林利安'),
        );
    }

    public function testPatterns()
    {
        $pattern = include __DIR__.'/../src/pattern.php';
        $this->assertEquals($pattern, $this->skeleton->getPattern());
    }
}
