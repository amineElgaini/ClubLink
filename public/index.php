<?php
session_start();
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
$router->setBasePath('ClubLink');

$router->get('/login', [AuthController::class, 'loginPage']);
$router->post('/login', [AuthController::class, 'loginAction']);
$router->get('/register', [AuthController::class, 'registerPage']);
$router->post('/register', [AuthController::class, 'registerAction']);

// Clubs
$router->get('/clubs', [ClubController::class, 'index']); // show all clubs
$router->get('/clubs/{id}', [ClubController::class, 'show']); // show club details

// Club articles
$router->get('/clubs/events/{id}', [ArticleController::class, 'show']); // show article
$router->post('/clubs/events/{id}/comments', [ArticleController::class, 'comment']); // post comment

// Club events
$router->post('/events/{id}/register', [EventController::class, 'register']); // register for event

// Events
$router->get('/events', [EventController::class, 'index']); // list events
$router->post('/events/{id}/delete', [EventController::class, 'destroy']); // delete event
$router->post('/events/{id}/update', [EventController::class, 'update']); // update event

// Articles
$router->get('/articles/create', [ArticleController::class, 'create']);
$router->post('/articles', [ArticleController::class, 'store']); // RESTful store

// Users
$router->get('/admin/users', [AdminController::class, 'index']);
$router->post('/admin/users/{id}/delete', [AdminController::class, 'destroy']);
$router->post('/admin/users/{id}/update', [AdminController::class, 'update']);
$router->post('/admin/users/{id}/make-president', [AdminController::class, 'makePresident']); // hyphenated for readability

// Clubs
$router->get('/admin/clubs', [ClubController::class, 'index']);
$router->post('/admin/clubs', [ClubController::class, 'store']); // create new
$router->post('/admin/clubs/{id}/update', [ClubController::class, 'update']);
$router->post('/admin/clubs/{id}/delete', [ClubController::class, 'destroy']); // fixed missing slash


// $router->get('/login', [AuthController::class, 'loginPage']);
// $router->post('/login', [AuthController::class, 'loginAction']);
// $router->get('/register', [AuthController::class, 'registerPage']);
// $router->post('/register', [AuthController::class, 'registerAction']);


// // student routes
// $router->get('/club', [ClubController::class, 'showClubsPage']);

// $router->get('/club/{id}', [ClubController::class, 'showClubsPage']);
// $router->post('/club/{id}', [ClubController::class, 'showClubsPage']);


// $router->get('/article/{id}', [ArticleController::class, 'showArticle']);
// $router->post('/club/{id}/article', [ArticleController::class, 'commentArticle']);

// $router->post('/event/{id}', [EventController::class, 'registerEvent']);

// // president routes
// $router->get('/event', [EventController::class, 'showEvents']);
// $router->post('/event/{id}/delete', [EventController::class, 'deleteEvent']);
// $router->post('/event/{id}/update', [EventController::class, 'updateEvent']);

// $router->get('/article/create', [ArticleController::class, 'createArticle']);
// $router->post('/article/store', [ArticleController::class, 'storeArticle']);


// $router->get('/admin/users', [AdminController::class, 'users']);
// $router->post('/admin/users/{id}/delete', [AdminController::class, 'delete']);
// $router->post('/admin/users/{id}/update', [AdminController::class, 'update']);
// $router->post('/admin/users/{id}/makePresident', [AdminController::class, 'makePresident']);

// $router->get('/admin/clubs', [ClubsController::class, 'clubs']);
// $router->post('/admin/clubs/{id}/create', [ClubController::class, 'createClub']);
// $router->post('/admin/clubs/{id}/update', [ClubController::class, 'updateClub']);
// $router->post('/admin/clubs/{id}delete', [ClubController::class, 'deleteClub']);

$router->dispatch();
