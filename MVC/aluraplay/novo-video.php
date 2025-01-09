<?php

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;
use Alura\Mvc\Persistence\ConnectionCreator;

require_once __DIR__ . '/vendor/autoload.php';

$connection = ConnectionCreator::createConnection();

$videoRepository = new VideoRepository($connection);

$url   = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if($url === false || $title === false){
    header('Location: /?success=0');
    exit();
}

try{
    $video = $videoRepository->addVideo(new Video($url, $title));
    header('Location: /?success=1');
}catch(PDOException $e){
    //todo: retonar mensagem de erro no front;
    header('Location: /?success=0');
}
