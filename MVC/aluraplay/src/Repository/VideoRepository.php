<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;

class VideoRepository
{
    public function __construct(private \PDO $pdo)
    {
    
    }

    public function addVideo(Video $video):Video
    {
        $sql  = 'INSERT INTO videos (url, title) VALUES (?, ?);'; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);

        $stmt->execute();
        
        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));
        return $video;
    }

    public function remove(int $id):void
    {
        $sql  = 'DELETE FROM videos WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function update(string $url, string $title, int $id):void 
    {
        $stmt = $this->pdo->prepare('UPDATE videos SET url = :url, title = :title WHERE id = :id');
        $stmt->bindValue(':url', $url);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

}