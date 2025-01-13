<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController  implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processRequest():void
    {
        $videoList = $this->videoRepository->all();
        require_once __DIR__ . '/../views/video-list.php';
    }
}