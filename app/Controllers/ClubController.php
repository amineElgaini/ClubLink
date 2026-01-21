<?php

require_once __DIR__ . '/../Models/Club.php';

class ClubController extends Controller {
    public function index() {
        $clubs = Club::getAllClubs();

        $this->view('student/show-clubs', ['clubs' => $clubs]);
    }

    public function show($id) {
        $clubId = (int)$id;

        if ($clubId <= 0) {
            throw new AppException("Invalid club id", 400);
        }

        $club = Club::findById($clubId);

        if (!$club) {
            throw new AppException("Club not found", 404);
        }

        $membersCount = Club::getMemberCount($clubId);
        $members = Club::getMembers($clubId, 8);

        $pastEvents = Club::getEvents($clubId, 3);
        $recentArticles = Club::getArticles($clubId, 3);

        $president = Club::getPresident($club);

        $userClubId = null;
        if (!empty($_SESSION['user'])) {
            $userClubId = Club::getUserClubId($_SESSION['user']->id);
        }

        $maxMembers = 8;
        $club['logo_url'] = 'https://ui-avatars.com/api/?name=' . urlencode($club['name']) . '&background=0d7ff2&color=fff&size=128';
        $club['members_count'] = $membersCount;
        $club['max_members'] = $maxMembers;
        $club['spots_left'] = max(0, $maxMembers - $membersCount);
        $club['is_full'] = $membersCount >= $maxMembers;
        $club['open_spots'] = $club['spots_left'];
        $club['tagline'] = $club['description'] ?? '';
        $club['location'] = $pastEvents[0]['location'] ?? 'Campus';
        $club['meeting_time'] = '—';

        $title = "Club Details - " . $club['name'];
        require __DIR__ . '/../Views/student/club-info.php';
    }

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

        if (!Club::exists($clubId)) {
            http_response_code(404);
            echo "Club not found";
            exit;
        }

        $count = Club::getMemberCount($clubId);
        if ($count >= $maxMembers) {
            $_SESSION['error'] = 'This club is full.';
            header("Location: /clubs/$clubId");
            exit;
        }

        $alreadyInClub = Club::getUserClubId($studentId);
        if ($alreadyInClub) {
            $_SESSION['error'] = ($alreadyInClub == $clubId)
                ? 'You are already a member of this club.'
                : 'You are already in another club.';
            header("Location: /clubs/$clubId");
            exit;
        }

        $success = Club::addMember($clubId, $studentId);
        
        if ($success) {
            $_SESSION['success'] = 'Successfully joined the club!';
        } else {
            $_SESSION['error'] = 'Could not join club. Please try again.';
        }

        header("Location: /clubs/$clubId");
        exit;
    }

    public function store() {}        // create new club (admin)
    public function update($id) {}   // update club (admin)
    public function destroy($id) {} // delete club (admin)
}
