<?php

class Router
{
    private string $basePath = '';
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];


    public function get(string $uri, $action): void
    {
        $this->routes['GET'][$this->normalize($uri)] = [
            'action' => $action
        ];
    }

    public function post(string $uri, $action): void
    {
        $this->routes['POST'][$this->normalize($uri)] = [
            'action' => $action
        ];
    }

    public function setBasePath(string $basePath): void
    {
        $this->basePath = '/' . trim($basePath, '/');
    }


    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove base path (e.g. /ClubLink)
        if ($this->basePath && str_starts_with($uri, $this->basePath)) {
            $uri = substr($uri, strlen($this->basePath));
        }

        $uri = $this->normalize($uri);

        if (isset($this->routes[$method][$uri])) {
            $this->runRoute($this->routes[$method][$uri]);
            return;
        }

        foreach ($this->routes[$method] as $route => $data) {
            if ($this->match($route, $uri, $params)) {
                $this->runRoute($data, $params);
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }

    private function runRoute(array $data, array $params = []): void
    {
        $action = $data['action'];

        if ($action instanceof Closure) {
            // If it's a closure, call it directly
            call_user_func_array($action, $params);
        } elseif (is_array($action) && count($action) === 2) {
            // Controller array [Controller, 'method']
            [$controller, $method] = $action;
            require_once __DIR__ . "/../app/Controllers/{$controller}.php";
            $instance = new $controller();
            call_user_func_array([$instance, $method], $params);
        } else {
            throw new Exception("Invalid route action");
        }
    }

    private function match(string $route, string $uri, &$params = []): bool
    {
        $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);
        $pattern = "#^{$pattern}$#";

        if (preg_match($pattern, $uri, $matches)) {
            array_shift($matches);
            $params = $matches;
            return true;
        }

        return false;
    }

    private function normalize(string $uri): string
    {
        return rtrim($uri, '/') ?: '/';
    }
}
