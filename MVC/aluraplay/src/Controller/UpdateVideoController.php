<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class UpdateVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processRequest():void
    {
        $id  = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if($id === false || $url === false){
            header('Location: /?success=0');
            exit();
        }

        $title = $_POST['titulo'];
        $video = new Video($url, $title);
        $video->setId($id);

        if($this->videoRepository->update($video)){
            header('Location: /?success=1');    
        }else {
            header('Location: /?success=0');
        }   
    }

}