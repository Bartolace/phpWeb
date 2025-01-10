<?php
use Alura\Mvc\Persistence\ConnectionCreator;
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$videoRepository = new VideoRepository($connection);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($videoRepository->remove($id)){
    header('Location: /?success=1');
}else {
    header('Location: /?success=0');
}