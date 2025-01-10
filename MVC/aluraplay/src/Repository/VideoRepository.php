<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDOException;
use PDO;

class VideoRepository
{
    public function __construct(private PDO $pdo)
    {
    
    }

    public function add(Video $video):bool
    {
        try{
            $sql  = 'INSERT INTO videos (url, title) VALUES (?, ?);'; 
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $video->url);
            $stmt->bindValue(2, $video->title);
    
            $result = $stmt->execute();
            
            $id = $this->pdo->lastInsertId();
            $video->setId(intval($id));
            return $result;

        }catch(PDOException $e){
            return false;
        }
    }

    public function remove(int $id):bool
    {
        try{
            $sql  = 'DELETE FROM videos WHERE id = ?';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            return $stmt->execute();
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(Video $video):bool 
    {
        try{
            var_dump($video->id);
            $stmt = $this->pdo->prepare('UPDATE videos SET url = :url, title = :title WHERE id = :id');
            $stmt->bindValue(':url', $video->url);
            $stmt->bindValue(':title', $video->title);
            $stmt->bindValue(':id', $video->id, PDO::PARAM_INT);
            return $stmt->execute();
        }catch(PDOException $e){
            return false;
        }
    }

    /**
     * Summary of all
     * @return Video[]
     */
    public function all():array
    {   
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll();

        return array_map(
            function (array $videoData) {
                $video = new Video($videoData['url'], $videoData['title']);
                $video->setId($videoData['id']);
    
                return $video;
        }, $videoList);
    }

    public function byId(int $id) 
    {
        try{
            $stmt  = $this->pdo->prepare('SELECT * from videos where id = ?');
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return throw new PDOException($e->getMessage());
        }
    }

}