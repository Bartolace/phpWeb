<?php

$dataBasePath = __DIR__ . '/banco.sql';
$pdo = new PDO('sqlite:' . $dataBasePath);

// queries whith out confer the result, return the number of afcted lines
$pdo->exec("CREATE TABLE students ( id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);");


