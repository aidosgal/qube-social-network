<?php

namespace App\Model;

use App\Database\Database;
use PDO;

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * Retrieve a user by ID.
     *
     * @param int $id User ID
     * @return array|null User data or null if not found
     */
    public function getUserById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, username, email FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Retrieve all users.
     *
     * @return array List of users
     */
    public function getAllUsers(): array
    {
        $stmt = $this->pdo->query('SELECT id, username, email FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a new user.
     *
     * @param string $username User's username
     * @param string $email User's email
     * @param string $password User's password (hashed)
     * @return bool True on success, false otherwise
     */
    public function addUser(string $username, string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $password
        ]);
    }

    /**
     * Update user information.
     *
     * @param int $id User ID
     * @param string $username New username
     * @param string $email New email
     * @return bool True on success, false otherwise
     */
    public function updateUser(int $id, string $username, string $email): bool
    {
        $stmt = $this->pdo->prepare('UPDATE users SET username = :username, email = :email WHERE id = :id');
        return $stmt->execute([
            'id'       => $id,
            'username' => $username,
            'email'    => $email
        ]);
    }

    /**
     * Delete a user.
     *
     * @param int $id User ID
     * @return bool True on success, false otherwise
     */
    public function deleteUser(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}

