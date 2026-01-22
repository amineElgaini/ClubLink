<?php
// app/Models/User.php

// require_once __DIR__ . '/../../config/Config.php';

class User
{
    /* =====================
       Attributes
    ===================== */
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $role;
    public string $created_at;

    /* =====================
       Constructor
    ===================== */
    public function __construct(array $data)
    {
        $this->id         = (int) $data['id'];
        $this->first_name = $data['first_name'];
        $this->last_name  = $data['last_name'];
        $this->email      = $data['email'];
        $this->role       = $data['role'];
        $this->created_at = $data['created_at'];
    }

    /* =====================
       Auth methods
    ===================== */

    /** LOGIN */
    public static function login(string $email, string $password): ?User
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "SELECT * FROM students WHERE email = :email LIMIT 1"
        );
        $stmt->execute(['email' => $email]);

        $data = $stmt->fetch();

        if (!$data || !password_verify($password, $data['password'])) {
            return null;
        }

        return new User($data);
    }

    /** REGISTER */
    public static function register(array $data): ?User
    {
        $pdo = Config::getPDO();

        // Email already exists
        $stmt = $pdo->prepare(
            "SELECT id FROM students WHERE email = :email"
        );
        $stmt->execute(['email' => $data['email']]);

        if ($stmt->fetch()) {
            return null;
        }

        // Insert user
        $stmt = $pdo->prepare(
            "INSERT INTO students (first_name, last_name, email, password, role)
             VALUES (:first_name, :last_name, :email, :password, :role)
             RETURNING *"
        );

        $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'       => $data['role'] ?? 'student',
         ]);

        return new User($stmt->fetch());
    }

    public static function logout(): void
    {
        // Remove user_id from session
        unset($_SESSION['user_id']);

        // Optional: destroy entire session
        session_destroy();
    }

    /* =====================
       Helpers
    ===================== */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }


public function isPresident(): bool
{
    $pdo = Config::getPDO();

    $sql = "SELECT EXISTS (
                SELECT 1 FROM clubs WHERE president_id = :id
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $this->id]);

    return (bool) $stmt->fetchColumn();
}


    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
