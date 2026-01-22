<?php

class Student
{
    public function all(): array
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->query(
            "SELECT id, first_name, last_name, email, role
    FROM students
    WHERE role != 'admin'"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(
        int $id,
        string $first,
        string $last,
        string $email,
        // string $role
    ): void {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "UPDATE students
    SET first_name = ?, last_name = ?, email = ?
    WHERE id = ?"
        );

        $stmt->execute([$first, $last, $email, $id]);
    }

    public function delete(int $id): void
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "DELETE FROM students
    WHERE id = ?"
        );

        $stmt->execute([$id]);
    }
}
