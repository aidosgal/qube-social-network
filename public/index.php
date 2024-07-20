<?php

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=your_database;charset=utf8mb4', 'your_user', 'your_password');

use App\Controller\UserController;
$controller = new UserController($pdo);

$controller->handleRequest();

