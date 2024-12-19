<?php

use Bartolace\Pdo\Domain\Model\Student;

require_once "vendor/autoload.php";

$dataBasePath = __DIR__ . '/banco.sql';
$pdo = new PDO('sqlite:' . $dataBasePath);

$statement = $pdo->query('SELECT * FROM students');



//when the process it's was heaviest, we can opt found one data at once to do what we desire, instead of take it all,
// what can compromise the memory

//just like fetch, run line to line, we can combinated with while
//$deliverColumn = $statement->fetchColumn(1);

//while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
//    $student = new Student(
//        $studentData['id'],
//        $studentData['name'],
//        new \DateTimeImmutable($studentData['birth_date']),
//    );
//    echo  $student->age() . PHP_EOL;
//}

//normally used :
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);

$studentList = [];

foreach ($studentDataList as $studentData) {
    $studentList[] = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date']),
    );
}
var_dump($studentList);
