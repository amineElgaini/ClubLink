<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController extends Controller
{
    public function loginPage()
    {
        $this->view('auth/login');
    }

    public function loginAction()
    {
        $user = User::login(
            $_POST['email'] ?? '',
            $_POST['password'] ?? ''
        );

        if (!$user) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: /login');
            exit;
        }

        $_SESSION['user'] = $user;
        header('Location: /clubs');
        exit;
    }

    public function registerPage()
    {
        $this->view('auth/register');
    }

    public function registerAction()
    {
        $user = User::register($_POST);

        if (!$user) {
            $_SESSION['error'] = 'Email already exists';
            header('Location: /register');
            exit;
        }

        $_SESSION['user'] = $user;
        header('Location: /clubs');
        exit;
    }

    public function logout(): void
    {
        User::logout();

        header('Location: ' . './login');
        exit;
    }
}
