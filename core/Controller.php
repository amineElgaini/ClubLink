<?php

class Controller
{
    protected function view(string $view, array $data = [])
    {
        extract($data);

        $viewFile = __DIR__ . '/../app/Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View file $viewFile not found");
        }

        require_once __DIR__ . '/../app/Views/layout.php';
    }
}
