<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Club.php';

class ClubController extends Controller {
    public function index() {
        $clubs = Club::getAllClubs();

        // Pass $clubs to the view
        $this->view('student/show-clubs', ['clubs' => $clubs]);
    }     

    public function show($id) {}    // show single club
    public function store() {}       // create new club (admin)
    public function update($id) {}  // update club (admin)
    public function destroy($id) {} // delete club (admin)
}
