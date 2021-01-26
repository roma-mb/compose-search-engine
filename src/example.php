<?php

require('vendor/autoload.php');

use App\Service\SearchEngine;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

//ClassMap example when not implements psr-4 https://www.php-fig.org/psr/psr-4/
//ClassMapExample::methodExample();

//files example, composer.json
//dd(['example']);

// https://packagist.org/packages/guzzlehttp/guzzle
$client  = new Client(['base_uri' => 'https://www.alura.com.br/']);

// https://packagist.org/packages/symfony/dom-crawler
$crawler = new Crawler();

$searchEngine = (new SearchEngine($client, $crawler))
    ->setMethod('GET')
    ->setSelector('span.card-curso__nome')
    ->setUrl('https://www.alura.com.br/cursos-online-programacao/php')
    ->run();

printList($searchEngine);
