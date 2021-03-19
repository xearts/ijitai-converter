<?php
include 'vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$url = 'http://wwwap.hi.u-tokyo.ac.jp/ships/itaiji_list.jsp';


$client = new Client();

$crawler = $client->request('GET', $url);


$rows = $crawler->filter('table.ITAIJI tr');

$patterns = array();
$iso2022Patterns = array();

$rows->each(function (Crawler $row) use (&$patterns, &$iso2022Patterns) {


    $cells = $row->filter('td');
    // ヘッダーなどはスキップ
    if ($cells->count() == 0) {
        return;
    }

    $replace = trim(str_replace(array('&nbsp;', '　'), ' ', $cells->eq(1)->text()));
    $searchs = preg_split('/\s+/u', trim(str_replace(array('&nbsp;', '　'), ' ', trim($cells->eq(2)->text()))));


    foreach ($searchs as $search) {
        if ($search) {
            $patterns[$search] = $replace;
            if (!isISO2022JPSafe($search)) {
                $iso2022Patterns[$search] = $replace;
            }
        }
    }
});

function isISO2022JPSafe($text)
{
    $iso2022 = mb_convert_encoding($text, 'ISO-2022-JP', 'UTF-8');
    $utf8 = mb_convert_encoding($iso2022, 'UTF-8', 'ISO-2022-JP');
    return $utf8 === $text;
}
file_put_contents(__DIR__.'/src/pattern.php', "<?php\nreturn " . var_export($patterns, true) . ";\n");
file_put_contents(__DIR__.'/src/iso_2022_jp_pattern.php', "<?php\nreturn " . var_export($iso2022Patterns, true) . ";\n");
