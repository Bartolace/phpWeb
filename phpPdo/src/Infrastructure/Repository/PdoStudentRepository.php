<?php

namespace Bartolace\Pdo\Infrastructure\Repository;

use Bartolace\Pdo\Domain\Model\Student;
use Bartolace\Pdo\Domain\Repository\StudentRepository;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO as PDO;

class PdoStudentRepository implements StudentRepository
{

    private PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function allStudents(): array
    {
        $studentList = [];
        $statement          = $this->connection->query('SELECT * FROM students;');
        $studentDataList    = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date']),
            );
        }

        return $studentList;
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $statement  = $this->connection->prepare('SELECT * FROM students WHERE birth_date = :birth_date;');
        $statement->bindValue(':birth_date', $birthDate);

        if ($statement->execute()) {
           return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function save(Student $student)
    {
        $statement = $this->connection->prepare('INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)');
        $statement->bindValue(':name', $student->name());
        $statement->bindValue(':birth_date', $student->birthDate()->format(format:'Y-m-d'));

        if ($statement->execute()) {
            echo 'Student added';
        }
    }

    public function remove(int $idStudent)
    {
        $statement = $this->connection->prepare('DELETE FROM students WHERE id = :id;');
        $statement->bindValue(':id', $idStudent, PDO::PARAM_INT);

        if ($statement->execute()) {
            echo 'Student removed';
        }
    }
}