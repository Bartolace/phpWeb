<?php

use Bartolace\Pdo\Domain\Model\Student;

require_once "vendor/autoload.php";

$dataBasePath = __DIR__ . '/banco.sql';
$pdo = new PDO('sqlite:' . $dataBasePath);

$student = new Student(null, "Vinicius', ''); DROP TABLE students; -- Dias", new \DateTimeImmutable('1998-07-28'));


$sqlInsert = "INSERT INTO students (name, birth_date) VALUES(?,?)";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1, $student->name());
$statement->bindValue(2, $student->birthDate()->format(format:'Y-m-d'));

if ($statement->execute()) {
    echo "Aluno incluído";
}