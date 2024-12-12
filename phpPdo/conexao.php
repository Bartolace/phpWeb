<?php

$dataBasePath = __DIR__ . '/banco.sql';
$pdo = new PDO('sqlite:' . $dataBasePath);


$pdo->exec("CREATE TABLE students ( id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);");


