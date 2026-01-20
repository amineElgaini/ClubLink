<?php
// app/Controllers/ClubController.php

require_once __DIR__ . '/../Models/Club.php';

class ClubController {
    public function index() {
        print_r($_SESSION);
    }       // show all clubs
    public function show($id) {
        $clubId = (int)$id;

        if ($clubId <= 0) {
            throw new AppException("Invalid club id", 400);
        }

        // Fetch club with president info
        $club = Club::findById($clubId);

        if (!$club) {
            throw new AppException("Club not found", 404);
        }

        // Get members count and list
        $membersCount = Club::getMemberCount($clubId);
        $members = Club::getMembers($clubId, 8);

        // Get events and articles
        $pastEvents = Club::getEvents($clubId, 3);
        $recentArticles = Club::getArticles($clubId, 3);

        // Get president data
        $president = Club::getPresident($club);

        // Check if logged-in user is already in a club
        $userClubId = null;
        if (!empty($_SESSION['user'])) {
            $userClubId = Club::getUserClubId($_SESSION['user']->id);
        }

        // Prepare club display data
        $maxMembers = 8; // You can make this dynamic later
        $club['logo_url'] = 'https://ui-avatars.com/api/?name=' . urlencode($club['name']) . '&background=0d7ff2&color=fff&size=128';
        $club['members_count'] = $membersCount;
        $club['max_members'] = $maxMembers;
        $club['spots_left'] = max(0, $maxMembers - $membersCount);
        $club['is_full'] = $membersCount >= $maxMembers;
        $club['open_spots'] = $club['spots_left'];
        $club['tagline'] = $club['description'] ?? '';
        $club['location'] = $pastEvents[0]['location'] ?? 'Campus';
        $club['meeting_time'] = '—';

        // Render view
        $title = "Club Details - " . $club['name'];
        require __DIR__ . '/../Views/student/club-info.php';
    }    // show single club
    public function join($id)
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login to join a club.';
            header('Location: /login');
            exit;
        }

        $studentId = (int)$_SESSION['user']->id;
        $clubId = (int)$id;
        $maxMembers = 8;

        // Check if club exists
        if (!Club::exists($clubId)) {
            http_response_code(404);
            echo "Club not found";
            exit;
        }

        // Check if club is full
        $count = Club::getMemberCount($clubId);
        if ($count >= $maxMembers) {
            $_SESSION['error'] = 'This club is full.';
            header("Location: /clubs/$clubId");
            exit;
        }

        // Check if student already in a club
        $alreadyInClub = Club::getUserClubId($studentId);
        if ($alreadyInClub) {
            $_SESSION['error'] = ($alreadyInClub == $clubId)
                ? 'You are already a member of this club.'
                : 'You are already in another club.';
            header("Location: /clubs/$clubId");
            exit;
        }

        // Add member to club
        $success = Club::addMember($clubId, $studentId);
        
        if ($success) {
            $_SESSION['success'] = 'Successfully joined the club!';
        } else {
            $_SESSION['error'] = 'Could not join club. Please try again.';
        }

        header("Location: /clubs/$clubId");
        exit;
    } // a student join a club 

    public function store() {}        // create new club (admin)
    public function update($id) {}   // update club (admin)
    public function destroy($id) {} // delete club (admin)
}
