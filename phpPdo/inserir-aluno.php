<?php

use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator as ConnectionCreator;
use Bartolace\Pdo\Infrastructure\Repository\PdoStudentRepository as PdoStudentRepository;

require_once "vendor/autoload.php";

$student = new Student(
    null,
    "Teste ConnectionCreator",
    new \DateTimeImmutable('1998-07-28')
);

$pdoStudent = new PdoStudentRepository();

$pdoStudent->save($student);


