<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class NewVideoController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processRequest():void
    {

        $url   = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');

        if($url === false || $title === false){
            header('Location: /?success=0');
            exit();
        }
        
        if($this->videoRepository->add(new Video($url, $title))){
            header('Location: /?success=1');
        }else {
            header('Location: /?success=0');
        }
        
    }

}