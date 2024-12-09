<?php

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
 
$client = new Client();

$response = $client->request('GET', 'https://cursos.alura.com.br/category/programacao/php');

$html =  $response->getBody();

$crawler = new Crawler();