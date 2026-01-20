<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
// app/Controllers/ClubController.php
class ClubController extends Controller{
    public function index() {
      if ($_SESSION['user']->role == "admin") {
      $this->view("admin/manage-clubs");
      }
    }       // show all clubs
    public function show($id) {}    // show single club
    public function store() {}       // create new club (admin)
    public function update($id) {}  // update club (admin)
    public function destroy($id) {} // delete club (admin)
}
