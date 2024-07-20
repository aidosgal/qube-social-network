<?php

namespace App\Controller;

use PDO;

abstract class Controller 
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Render a view file with given data.
     *
     * @param string $viewPath Relative path to the view file.
     * @param array $data Data to pass to the view.
     */
    protected function render(string $viewPath, array $data = []): void
    {
        extract($data); // Extracts variables from the array to be used in the view
        include __DIR__ . '/../../templates/' . $viewPath;
    }

    /**
     * Handle a request action.
     * Must be implemented by subclasses.
     */
    abstract public function handleRequest();
}

