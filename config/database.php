<?php

class Config
{
    public static function getPDO(): PDO
    {
        $driver = $_ENV['DB_DRIVER'];
        $host   = $_ENV['DB_HOST'];
        $port   = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $user   = $_ENV['DB_USER'];
        $pass   = $_ENV['DB_PASSWORD'];

        $dsn = "$driver:host=$host;port=$port;dbname=$dbname";

        try {
            return new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
