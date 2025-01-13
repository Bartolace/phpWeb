<?php

declare(strict_types=1);

use Alura\Mvc\Persistence\ConnectionCreator;
use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\ErrorController;

require_once __DIR__ . '/../vendor/autoload.php';

$connection      = ConnectionCreator::createConnection();
$videoRepository = new VideoRepository($connection);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo   = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key        = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];
    $controller      = new $controllerClass($videoRepository);
}else {
    $controller = new ErrorController();
}
 
/** @var Controller $controller */
$controller->processRequest();