<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Club.php';

class ClubController extends Controller {
    
    // Show all clubs
    public function index() {
        $clubs = Club::getAllClubs();
        $this->view('admin/manage-clubs', ['clubs' => $clubs]);
    }

    // Create a new club (admin)
    public function store() {
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $president_id = $_POST['president_id'] ?? null;

        $club = new Club($name, $description, $president_id);
        if ($club->createClub()) {
            header('Location: /admin/clubs'); // redirect to club list
            exit;
        } else {
            echo "Failed to create club.";
        }
    }

    // Update a club (admin)
    public function update($id) {
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $president_id = $_POST['president_id'] ?? null;

        if (Club::updateClub($id, $name, $description, $president_id)) {
            header('Location: /admin/clubs');
            exit;
        } else {
            echo "Failed to update club.";
        }
    }

    // Delete a club (admin)
    public function destroy($id) {
        if (Club::deleteClub($id)) {
            header('Location: /admin/clubs');
            exit;
        } else {
            echo "Failed to delete club.";
        }
    }

    // Show single club
    public function show($id) {
        $club = Club::getClubById($id);
        $this->view('admin/show-single-club', ['club' => $club]);
    }
}
