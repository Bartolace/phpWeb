<?php
require_once "vendor/autoload.php";

$dataBasePath = __DIR__ . '/banco.sql';
$pdo = new PDO('sqlite:' . $dataBasePath);

$result = $pdo->query('SELECT * FROM students');

$studentList = $result->fetchAll();


var_dump( $studentList);