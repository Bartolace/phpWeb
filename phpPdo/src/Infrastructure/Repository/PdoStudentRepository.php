<?php

namespace Bartolace\Pdo\Infrastructure\Repository;

use Bartolace\Pdo\Domain\Model\Phone;
use Bartolace\Pdo\Domain\Model\Student;

use Bartolace\Pdo\Domain\Repository\StudentRepository;
use Bartolace\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO as PDO;

class PdoStudentRepository implements StudentRepository
{

    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $stmt = $this->connection->query('SELECT * FROM students;');

        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $statement  = $this->connection->prepare('SELECT * FROM students WHERE birth_date = :birth_date;');
        $statement->bindValue(':birth_date', $birthDate->format('Y-m-d'));
        $statement->execute();

        return $this->hydrateStudentList($statement);
    }

    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date']),
            );
        }

        return $studentList;
    }

    public function save(Student $student)
    {
        if($student->id() === null) {
            return $this->insert($student);
        }

        return $this->update($student);

    }

    public function update(Student $student)
    {
        $stmt = $this->connection->prepare('
            UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;');

        $stmt->bindValue(':name',       $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id',         $student->id(), PDO::PARAM_INT);

        echo 'Successfully updated student: ' . $student->id();
        return $stmt->execute();
    }

    public function insert(Student $student)
    {
        $statement = $this->connection->prepare('INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)');
        $success = $statement->execute([
                ':name' => $student->name(),
                ':birth_date' => $student->birthDate()->format('Y-m-d'),
        ]);

        if($success){
            echo 'success' . PHP_EOL;
            $student->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    public function remove(int $idStudent)
    {
        $statement = $this->connection->prepare('DELETE FROM students WHERE id = :id;');
        $statement->bindValue(':id', $idStudent, PDO::PARAM_INT);

        if ($statement->execute()) {
            echo 'Student removed';
        }
    }

    public function studentsWithPhones(): array
    {
        $sqlQuery = ' SELECT students.id,
            students.name,
            students.birth_date,
            phones.id AS phone_id,
            phones.area_code,
            phones.number
        FROM students
        JOIN phones ON students.id = phones.student_id ';    

        $stmt   = $this->connection->query($sqlQuery);
        $result = $stmt->fetchAll();
        $studentList = [];

        foreach($result as $row){
            if(!array_key_exists($row['id'], $studentList)){
                $studentList[$row['id']] = new Student(
                    $row['id'],
                    $row['name'],
                    new \DateTimeImmutable($row['birth_date'])
                );
            }
            $phone = new Phone($row['phone_id'], $row['area_code'], $row['number']);
            $studentList[$row['id']]->addPhone($phone);
        }

        return $studentList;
    }
}