<?php

namespace App\Tests\Model;

use App\Database\Database;
use App\Model\User;
use PDO;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private PDO $pdo;
    private User $userModel;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec('
            CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL
            )
        ');

        $this->userModel = new User();
        $this->userModel->setPdo($this->pdo);
    }

    public function testAddUser(): void
    {
        $result = $this->userModel->addUser('john_doe', 'john@example.com', 'hashed_password');
        $this->assertTrue($result, 'Failed to add user');

        $user = $this->userModel->getUserById(1);
        $this->assertNotNull($user, 'User was not found');
        $this->assertEquals('john_doe', $user['username']);
        $this->assertEquals('john@example.com', $user['email']);
    }

    public function testGetAllUsers(): void
    {
        $this->userModel->addUser('john_doe', 'john@example.com', 'hashed_password');
        $this->userModel->addUser('jane_doe', 'jane@example.com', 'hashed_password');

        $users = $this->userModel->getAllUsers();
        $this->assertCount(2, $users);
        $this->assertEquals('john_doe', $users[0]['username']);
        $this->assertEquals('jane_doe', $users[1]['username']);
    }

    public function testUpdateUser(): void
    {
        $this->userModel->addUser('john_doe', 'john@example.com', 'hashed_password');
        $this->userModel->updateUser(1, 'john_doe_updated', 'john_updated@example.com');

        $user = $this->userModel->getUserById(1);
        $this->assertEquals('john_doe_updated', $user['username']);
        $this->assertEquals('john_updated@example.com', $user['email']);
    }

    public function testDeleteUser(): void
    {
        $this->userModel->addUser('john_doe', 'john@example.com', 'hashed_password');
        $this->userModel->deleteUser(1);

        $user = $this->userModel->getUserById(1);
        $this->assertNull($user, 'User was not deleted');
    }
}

