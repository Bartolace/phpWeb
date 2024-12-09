<?php
require 'vendor/autoload.php';

use Alura\BuscadorCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


$client   =   new Client(['base_uri' => 'http://www.alura.com.br/']);
$crawler  =   new Crawler();

$buscador =   new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo exibeMensagem($curso);
}