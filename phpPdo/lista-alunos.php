<?php

use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Bartolace\Pdo\Infrastructure\Repository\PdoStudentRepository as PdoStudentRepository;

require_once "vendor/autoload.php";

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

try{
    var_dump($studentRepository->allStudents());

} catch(PDOException $e){
    echo $e->getMessage();
}

//$deliverColumn = $statement->fetchColumn(1);

//when the process it's was heaviest, we can opt found one data at once to do what we desire, instead of take it all,
//what can compromise the memory
//to run line to line, we can combinated with while
//while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
//    $student = new Student(
//        $studentData['id'],
//        $studentData['name'],
//        new \DateTimeImmutable($studentData['birth_date']),
//    );
//    echo  $student->age() . PHP_EOL;
//}
