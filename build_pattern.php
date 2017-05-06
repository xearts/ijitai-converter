<?php
include 'vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$url = 'http://wwwap.hi.u-tokyo.ac.jp/ships/itaiji_list.jsp';


$client = new Client();

$crawler = $client->request('GET', $url);


$rows = $crawler->filter('table.ITAIJI tr');

$patterns = array();

$rows->each(function (Crawler $row) use (&$patterns) {


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
        }
    }
});

file_put_contents(__DIR__.'/src/pattern.php', "<?php\nreturn " . var_export($patterns, true) . ";\n");
