<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$envFile = __DIR__ . '/../.env';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

define('BASE_URL', '/ClubLink');
function url(string $path = ''): string
{
    $base = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $base . '/' . $path;
}



require_once __DIR__ . '/../core/Logger.php';
require_once __DIR__ . '/../core/AppException.php';
require_once __DIR__ . '/../core/ErrorHandler.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../core/Controller.php';

session_start();
ErrorHandler::register();



require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Router.php';

$router = new Router();
$router->setBasePath('ClubLink');

// Auth
$router->get('/login', [AuthController::class, 'loginPage']);
$router->post('/login', [AuthController::class, 'loginAction']);
$router->get('/register', [AuthController::class, 'registerPage']);
$router->post('/register', [AuthController::class, 'registerAction']);
$router->get('/logout', [AuthController::class, 'logout']);

// Club Page
$router->get('/clubs', [ClubController::class, 'index']);
$router->get('/clubs/{id}', [ClubController::class, 'show']);
$router->post('/clubs/{id}/join', [ClubController::class, 'join']);


// Event Detail
$router->get('/clubs/event/{id}', [ArticleController::class, 'show']);
$router->post('/clubs/event/{id}/comment', [ArticleController::class, 'comment']);
$router->post('/clubs/event/{id}/register', [EventController::class, 'register']);


// Events
$router->get('/president/events', [EventController::class, 'index']);
$router->post('/president/events', [EventController::class, 'create']);
$router->post('/president/events/{id}/delete', [EventController::class, 'destroy']);
$router->post('/president/events/{id}/update', [EventController::class, 'update']);

$router->get('/president/events/{id}/article', [ArticleController::class, 'create']);
$router->post('/president/events/{id}/article', [ArticleController::class, 'create']);


// Manage Users
$router->get('/admin/users', [AdminController::class, 'index']);
$router->post('/admin/users/{id}/delete', [AdminController::class, 'destroy']);
$router->post('/admin/users/{id}/update', [AdminController::class, 'update']);


// Manage Clubs
$router->get('/admin/clubs', [ClubController::class, 'manageClubs']);
$router->post('/admin/clubs', [ClubController::class, 'store']);
$router->post('/admin/clubs/{id}/update', [ClubController::class, 'update']);
$router->post('/admin/clubs/{id}/delete', [ClubController::class, 'destroy']);

$router->dispatch();