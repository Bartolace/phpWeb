<?php

use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Bartolace\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($connection); 

try{
    /**
     * @var Student[]
     */
    $studentList = $repository->studentsWithPhones();

    echo $studentList[1]->phones()[0]->formattedPhone();
}catch(PDOException $e){
    echo $e->getMessage();
}

