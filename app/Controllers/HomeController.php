<?php
require_once __DIR__ . '/../../core/Controller.php';
class HomeController extends Controller
{
    // The default action for "/"
    public function index()
    {
        $users = ['Alice', 'Bob', 'Charlie'];

        $this->view('home', ['users' => $users]);
    }
}
