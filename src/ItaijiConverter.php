<?php
/**
 * This file is part of the xearts.itaiji-converter
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Xearts\ItaijiConverter;

/**
 * Class ItaijiConverter
 * @package Xearts\ItaijiConverter
 */
class ItaijiConverter
{
    protected $pattern = array ();

    public function __construct($filename = 'pattern.php')
    {
        $this->pattern = include __DIR__.'/'.$filename;
    }

    /**
     * @param string $string
     * @return string
     */
    public function convert($string)
    {
        return str_replace(array_keys($this->pattern), array_values($this->pattern), $string);
    }

    /**
     * @return array
     */
    public function getPattern()
    {
        return $this->pattern;
    }
}
