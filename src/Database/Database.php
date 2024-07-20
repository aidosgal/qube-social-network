<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;
    private static string $dsn = 'mysql:host=localhost;dbname=your_database;charset=utf8mb4';
    private static string $user = 'your_user';
    private static string $password = 'your_password';

    private function __construct(){}

    private function __clone(){}

    private function __wakeup(){}

    public static function getInstance(): PDO
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(self::$dsn, self::$user, self::$password, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                echo "Database connection failed: " . $e->getMessage();
                exit(1);
            }
        }

        return self::$pdo;
    }
}

