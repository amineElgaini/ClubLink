<?php
// app/Controllers/ClubController.php
class ClubController {
    public function index() {
        print_r($_SESSION);
    }       // show all clubs
    public function show($id) {
        $pdo = Config::getPDO();
        $clubId = (int)$id;

        if ($clubId <= 0) {
            throw new AppException("Invalid club id", 400);
        }

        // 1) Club + President (if exists)
        $stmt = $pdo->prepare("
            SELECT
                c.*,
                s.id   AS president_id,
                s.first_name AS president_first_name,
                s.last_name  AS president_last_name,
                s.email      AS president_email
            FROM clubs c
            LEFT JOIN students s ON s.id = c.president_id
            WHERE c.id = :id
            LIMIT 1
        ");
        $stmt->execute(['id' => $clubId]);
        $club = $stmt->fetch();

        if (!$club) {
            throw new AppException("Club not found", 404);
        }

        // 2) Members count
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM club_members WHERE club_id = :id");
        $stmt->execute(['id' => $clubId]);
        $membersCount = (int)$stmt->fetchColumn();

        // 3) Members list (for the grid)
        $maxMembers = 8; // simple fixed capacity
        $stmt = $pdo->prepare("
            SELECT s.id, s.first_name, s.last_name
            FROM club_members cm
            JOIN students s ON s.id = cm.student_id
            WHERE cm.club_id = :id
            ORDER BY cm.joined_at ASC
            LIMIT :lim
        ");
        $stmt->bindValue(':id', $clubId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', $maxMembers, PDO::PARAM_INT);
        $stmt->execute();
        $members = $stmt->fetchAll();

        // Add simple avatar URLs (so your view can do background-image)
        foreach ($members as &$m) {
            $m['full_name'] = $m['first_name'] . ' ' . $m['last_name'];
            $m['avatar_url'] = 'https://ui-avatars.com/api/?name=' . urlencode($m['full_name']);
        }
        unset($m);

        // 4) Past events (sidebar)
        $stmt = $pdo->prepare("
            SELECT id, title, description, event_date, location
            FROM events
            WHERE club_id = :id AND event_date < CURRENT_DATE
            ORDER BY event_date DESC
            LIMIT 3
        ");
        $stmt->execute(['id' => $clubId]);
        $pastEvents = $stmt->fetchAll();

        foreach ($pastEvents as &$e) {
            $ts = strtotime($e['event_date']);
            $e['month'] = date('M', $ts);  // ex: Mar
            $e['day']   = date('d', $ts);  // ex: 12
        }
        unset($e);

        // 5) Recent articles (sidebar)
        $stmt = $pdo->prepare("
            SELECT id, title, image_url, created_at
            FROM articles
            WHERE club_id = :id
            ORDER BY created_at DESC
            LIMIT 3
        ");
        $stmt->execute(['id' => $clubId]);
        $recentArticles = $stmt->fetchAll();

        foreach ($recentArticles as &$a) {
            $a['date_text'] = date('F j, Y', strtotime($a['created_at']));
        }
        unset($a);

        // 6) President data (simple)
        $president = null;
        if (!empty($club['president_id'])) {
            $full = trim(($club['president_first_name'] ?? '') . ' ' . ($club['president_last_name'] ?? ''));
            $president = [
                'id' => (int)$club['president_id'],
                'full_name' => $full ?: 'Club President',
                'email' => $club['president_email'] ?? '',
                'avatar_url' => 'https://ui-avatars.com/api/?name=' . urlencode($full ?: 'President'),
                // optional text (you can change later in DB)
                'subtitle' => "President",
                'quote' => "Feel free to reach out about membership!",
            ];
        }

        // 7) Extra values for your HTML
        $club['logo_url'] = 'https://ui-avatars.com/api/?name=' . urlencode($club['name']) . '&background=0d7ff2&color=fff&size=128';
        $club['members_count'] = $membersCount;
        $club['max_members']   = $maxMembers;
        $club['spots_left']    = max(0, $maxMembers - $membersCount);
        $club['is_full']       = $membersCount >= $maxMembers;
        $club['open_spots']    = $club['spots_left'];

        $userClubId = null;
        if (!empty($_SESSION['user'])) {
            $stmt = $pdo->prepare("SELECT club_id FROM club_members WHERE student_id = :sid LIMIT 1");
            $stmt->execute(['sid' => (int)$_SESSION['user']->id]);
            $userClubId = $stmt->fetchColumn() ?: null;
        }


        // (these columns don't exist in your DB, so we keep them simple)
        $club['tagline'] = $club['description'] ?? '';
        $club['location'] = $pastEvents[0]['location'] ?? 'Campus';
        $club['meeting_time'] = '—';

        // 8) Render the view (put your big Tailwind HTML in this file)
        $title = "Club Details - " . $club['name'];
        require __DIR__ . '/../Views/student/club-info.php';
    }    // show single club
    public function join($id)
    {
        // must be logged in
        if (empty($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login to join a club.';
            header('Location: /login');
            exit;
        }

        $studentId = (int) $_SESSION['user']->id;
        $clubId = (int) $id;

        $pdo = Config::getPDO();
        $maxMembers = 8;

        // 1) check club exists
        $stmt = $pdo->prepare("SELECT id FROM clubs WHERE id = :id");
        $stmt->execute(['id' => $clubId]);
        if (!$stmt->fetch()) {
            http_response_code(404);
            echo "Club not found";
            exit;
        }

        // 2) check if club is full
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM club_members WHERE club_id = :club_id");
        $stmt->execute(['club_id' => $clubId]);
        $count = (int) $stmt->fetchColumn();

        if ($count >= $maxMembers) {
            $_SESSION['error'] = 'This club is full.';
            header("Location: /clubs/$clubId");
            exit;
        }

        // 3) check if student already in another club (or same club)
        $stmt = $pdo->prepare("SELECT club_id FROM club_members WHERE student_id = :student_id LIMIT 1");
        $stmt->execute(['student_id' => $studentId]);
        $already = $stmt->fetchColumn();

        if ($already) {
            $_SESSION['error'] = ($already == $clubId)
                ? 'You are already a member of this club.'
                : 'You are already in another club.';
            header("Location: /clubs/$clubId");
            exit;
        }

        // 4) insert membership
        try {
            $stmt = $pdo->prepare("INSERT INTO club_members (club_id, student_id) VALUES (:club_id, :student_id)");
            $stmt->execute(['club_id' => $clubId, 'student_id' => $studentId]);
        } catch (PDOException $e) {
            // if unique constraint hits (student already in a club)
            $_SESSION['error'] = 'You cannot join (maybe you are already in a club).';
        }

        header("Location: /clubs/$clubId");
        exit;
    } // a student join a club 

    public function store() {}       // create new club (admin)
    public function update($id) {}  // update club (admin)
    public function destroy($id) {} // delete club (admin)
}
