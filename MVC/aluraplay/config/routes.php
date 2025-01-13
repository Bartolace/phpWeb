<?php

use Alura\Mvc\Controller\FormController;
use Alura\Mvc\Controller\NewVideoController;
use Alura\Mvc\Controller\RemoveController;
use Alura\Mvc\Controller\UpdateVideoController;
use Alura\Mvc\Controller\VideoListController;

return [
  "GET|/" => VideoListController::class,
  "GET|/novo-video" => FormController::class,
  "POST|/novo-video" => NewVideoController::class,
  "GET|/editar-video" => FormController::class,
  "POST|/editar-video" => UpdateVideoController::class,
  "GET|/remover-video" => RemoveController::class
];