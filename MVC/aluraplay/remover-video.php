<?php
$dbPath = __DIR__ . '/banco.sqlite';
$pdo    = new PDO("sqlite:$dbPath");

$id   = $_GET['id']; 

$sql  = 'DELETE FROM videos WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id);

if($stmt->execute() === false) {
    header('Location: /?success=0');
} else {
    header('Location: /?success=1');
}