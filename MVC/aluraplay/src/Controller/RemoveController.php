<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;


class RemoveController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processRequest():void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if($this->videoRepository->remove($id)){
            header('Location: /?success=1');
        }else {
            header('Location: /?success=0');
        }
    }
}