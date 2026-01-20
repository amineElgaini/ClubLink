<?php
class Controller
{
    protected function view(string $view, array $data = [])
    {
        // Make $data keys available as variables
        extract($data);

        $viewFile = __DIR__ . '/../app/Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View file $viewFile not found");
        }

        // Include layout first
        require_once __DIR__ . '/../app/Views/layout.php';
    }
}
