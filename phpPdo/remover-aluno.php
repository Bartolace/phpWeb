<?php

use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Bartolace\Pdo\Infrastructure\Repository\PdoStudentRepository as PdoStudentRepository;

require_once "vendor/autoload.php";

$connection = ConnectionCreator::createConnection();
$pdoStudent = new PdoStudentRepository($connection);

$pdoStudent->remove(16);