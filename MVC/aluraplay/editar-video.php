<?php
use Alura\Mvc\Persistence\ConnectionCreator;
use Alura\Mvc\Repository\VideoRepository;

$connection = ConnectionCreator::createConnection();
$videoRepository = new VideoRepository($connection);

require_once __DIR__ . '/vendor/autoload.php';

$id  = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if($id === false || $url === false){
    header('Location: /?success=0');
    exit();
}
$title  = $_POST['titulo'];


try{
    $videoRepository->update($url, $title, $id);
    header('Location: /?success=1');    
}catch(PDOException $e){
    header('Location: /?success=0');
}