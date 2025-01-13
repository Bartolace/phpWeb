<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Persistence\ConnectionCreator;
use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class FormController implements Controller
{


    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processRequest():void
    {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $video = [
            "url" => '',
            'title' => ''
        ];

        if(!empty($id)){
            $video = $this->videoRepository->byId($id);
        }

        require_once __DIR__ . '/../views/video-form.php';
    }
}