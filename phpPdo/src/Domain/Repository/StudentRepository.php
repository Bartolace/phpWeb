<?php

namespace Bartolace\Pdo\Domain\Repository;

use Bartolace\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function studentsBirthAt(\DateTimeInterface $birthDate): array;
    public function save(Student $student);
    public function remove(int $idStudent);
}