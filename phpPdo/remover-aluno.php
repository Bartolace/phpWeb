<?php

use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Infrastructure\Repository\PdoStudentRepository as PdoStudentRepository;

require_once "vendor/autoload.php";

$pdoStudent = new PdoStudentRepository();

$pdoStudent->remove(9);