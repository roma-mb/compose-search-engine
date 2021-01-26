#!/usr/bin/env php
<?php

require('vendor/autoload.php');

use App\Service\SearchEngine;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client  = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$searchEngine = (new SearchEngine($client, $crawler))
    ->setMethod('GET')
    ->setSelector('span.card-curso__nome')
    ->setUrl('https://www.alura.com.br/cursos-online-programacao/php')
    ->run();

printList($searchEngine);
