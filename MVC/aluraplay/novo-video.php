<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo    = new PDO("sqlite:$dbPath");

$url   = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if($url === false || $title === false){
    header('Location: /?success=0');
    exit();
}

try{
    $sql  = 'INSERT INTO videos (url, title) VALUES (?, ?);'; 
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $url);
    $stmt->bindValue(2, $title);
    
    $stmt->execute();
    header('Location: /?success=1');

}catch(PDOException $e){
    header('Location: /?success=0');
}
