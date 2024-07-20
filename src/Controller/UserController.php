<?php

namespace App\Controller;

class UserController extends Controller
{
    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'listUsers';

        switch ($action) {
            case 'showUser':
                $id = $_GET['id'] ?? 0;
                $this->showUser($id);
                break;

            case 'listUsers':
            default:
                $this->listUsers();
                break;
        }
    }

    private function listUsers()
    {
        $stmt = $this->pdo->query('SELECT id, username, email FROM users');
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->render('user/list.php', ['users' => $users]);
    }

    private function showUser($id)
    {
        $stmt = $this->pdo->prepare('SELECT id, username, email FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            http_response_code(404);
            echo "User not found";
            return;
        }

        $this->render('user/show.php', ['user' => $user]);
    }
}
