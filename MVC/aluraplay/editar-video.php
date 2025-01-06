<?php
$dbPath = __DIR__ . '/banco.sqlite';
$pdo    = new PDO("sqlite:$dbPath");

$id  = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if($id === false || $url === false){
    header('Location: /?success=0');
    exit();
}

$title  = $_POST['titulo'];

$stmt = $pdo->prepare('UPDATE videos SET url = :url, title = :title WHERE id = :id');
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if($stmt->execute() === false) {
    header('Location: /?success=0');
} else {
    header('Location: /?success=1');
}