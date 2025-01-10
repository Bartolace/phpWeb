<?php

declare(strict_types=1);

use Alura\Mvc\Persistence\ConnectionCreator;
use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\{
    UpdateVideoController,
    VideoListController,
    FormController,
    NewVideoController,
    RemoveController
};

require_once __DIR__ . '/../vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$videoRepository = new VideoRepository($connection);


if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    $controller = new VideoListController($videoRepository);
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormController($videoRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NewVideoController($videoRepository);
    }
}  elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormController($videoRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new UpdateVideoController($videoRepository);
    }
}   elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
        $controller = new RemoveController($videoRepository);
} else {
    http_response_code(404);
}

$controller->processRequest();