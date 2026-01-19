<?php
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

require_once __DIR__ . '/../core/Logger.php';
require_once __DIR__ . '/../core/AppException.php';
require_once __DIR__ . '/../core/ErrorHandler.php';

ErrorHandler::register();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Router.php';

$router = new Router();

$router->get('/test/by', function() {
    echo 'Hello World!';
});



$router->dispatch();
