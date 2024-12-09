<?php

use GuzzleHttp\Client;
 
$client = new Client();

$response = $client->request('GET', 'https://cursos.alura.com.br/category/programacao/php');

$html =  $response->getBody();