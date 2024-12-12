<?php

use Bartolace\Pdo\Domain\Model\Student;

require_once "vendor/autoload.php";

$dataBasePath = __DIR__ . '/banco.sql';
$pdo = new PDO('sqlite:' . $dataBasePath);

$student = new Student(null, 'Gabriel Bartolace', new \DateTimeImmutable('1998-07-28'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";

var_dump($pdo->exec($sqlInsert));
