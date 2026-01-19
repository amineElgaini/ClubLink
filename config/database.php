<?php
// config/Config.php

class Config
{
    private static ?PDO $pdo = null;

    // Prevent creating instance
    private function __construct() {}
    private function __clone() {}

    public static function getPDO(): PDO
    {
        if (self::$pdo === null) {
            $driver = $_ENV['DB_DRIVER'];
            $host   = $_ENV['DB_HOST'];
            $port   = $_ENV['DB_PORT'];
            $dbname = $_ENV['DB_NAME'];
            $user   = $_ENV['DB_USER'];
            $pass   = $_ENV['DB_PASSWORD'];

            $dsn = "$driver:host=$host;port=$port;dbname=$dbname";

            try {
                self::$pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
