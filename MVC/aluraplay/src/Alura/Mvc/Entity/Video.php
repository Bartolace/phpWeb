<?php

namespace Alura\Mvc\Entity;

class Video{
    private $id;
    private $titulo;
    private $url;

    public function __construct($id, $titulo, $url){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->url = $url;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getUrl(){
        return $this->url;
    }
}