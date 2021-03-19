<?php
namespace Xearts\ItaijiConverter;

class Iso2022JPConverter extends ItaijiConverter
{
    public function __construct()
    {
        parent::__construct('iso_2022_jp_pattern.php');
    }
}