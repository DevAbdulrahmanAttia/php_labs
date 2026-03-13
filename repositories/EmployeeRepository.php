<?php

namespace Repositories;

use Config\Database;
use Models\Employee;
use PDO;

class EmployeeRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM emp');
        $rows = $stmt->fetchAll();

        return array_map([$this, 'mapToEmployee'], $rows);
    }

    public function findById(int $id): ?Employee
    {
        $stmt = $this->db->prepare('SELECT * FROM emp WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? $this->mapToEmployee($row) : null;
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM emp WHERE username = ?');
        $stmt->execute([$username]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(Employee $employee, string $plainPassword): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO emp (f_name, l_name, email, address, username, password, image)
             VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        return $stmt->execute([
            $employee->firstName,
            $employee->lastName,
            $employee->email,
            $employee->address,
            $employee->username,
            password_hash($plainPassword, PASSWORD_BCRYPT),
            $employee->image,
        ]);
    }

    public function update(Employee $employee): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE emp SET f_name = ?, l_name = ?, email = ?, address = ?, image = ? WHERE id = ?'
        );

        return $stmt->execute([
            $employee->firstName,
            $employee->lastName,
            $employee->email,
            $employee->address,
            $employee->image,
            $employee->id,
        ]);
    }

    public function updatePassword(int $id, string $hashedPassword): bool
    {
        $stmt = $this->db->prepare('UPDATE emp SET password = ? WHERE id = ?');
        return $stmt->execute([$hashedPassword, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM emp WHERE id = ?');
        return $stmt->execute([$id]);
    }

    private function mapToEmployee(array $row): Employee
    {
        return new Employee(
            id:        (int) ($row['id']       ?? 0),
            firstName: $row['f_name']           ?? '',
            lastName:  $row['l_name']           ?? '',
            email:     $row['email']            ?? '',
            address:   $row['address']          ?? '',
            username:  $row['username']         ?? '',
            image:     $row['image']            ?? ''
        );
    }
}
