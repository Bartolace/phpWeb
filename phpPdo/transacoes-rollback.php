<?php


use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Bartolace\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

$connection->beginTransaction();

try{
    $aStudent = new Student(
        null,
        'Nico Steppat',
        new DateTimeimmutable('1985-05-01')
    );
    $studentRepository->save($aStudent);
    
    $anotherStudent = new Student(
        null,
        'Sergio Lopes',
        new DateTimeimmutable('1985-05-01')
    );
    
    $studentRepository->save($anotherStudent);
    //$connection->commit();

}catch(PDOException $e ){
    echo $e->getMessage() . PHP_EOL;
    $connection->rollBack();
}





