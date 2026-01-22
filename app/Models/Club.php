<?php

class Club
{
    private $name;
    private $description;
    private $president_id;
    private PDO $db;

    public function __construct($name = null, $description = null, $president_id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->president_id = $president_id;
        $this->db = Config::getPDO();
    }

    /**
     * Get all clubs
     */
    public static function getAllClubs(): array
    {
        $pdo = Config::getPDO();
        $sql = "SELECT * FROM clubs";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find club by ID with president information
     */
    public static function findById($id)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            SELECT c.*,
                   s.id AS president_id,
                   s.first_name AS president_first_name,
                   s.last_name AS president_last_name,
                   s.email AS president_email
            FROM clubs c
            LEFT JOIN students s ON s.id = c.president_id
            WHERE c.id = :id
            LIMIT 1
        ");
        $stmt->execute(['id' => (int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all clubs
     */
    public static function getAll()
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->query("
            SELECT c.*,
                   COUNT(cm.id) as members_count
            FROM clubs c
            LEFT JOIN club_members cm ON c.id = cm.club_id
            GROUP BY c.id
            ORDER BY c.name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Make a student president of a club
     */
    public static function makePresident($clubId, $studentId)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            UPDATE clubs
            SET president_id = :student_id
            WHERE id = :club_id
        ");
        return $stmt->execute([
            'club_id' => (int)$clubId,
            'student_id' => (int)$studentId
        ]);
    }

    /**
     * Get member count for a club
     */
    public static function getMemberCount($clubId)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            SELECT COUNT(*)
            FROM club_members
            WHERE club_id = :id
        ");
        $stmt->execute(['id' => (int)$clubId]);
        return (int)$stmt->fetchColumn();
    }

    /**
     * Get members list for a club
     */
    public static function getMembers($clubId, $limit = 8)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            SELECT s.id, s.first_name, s.last_name
            FROM club_members cm
            JOIN students s ON s.id = cm.student_id
            WHERE cm.club_id = :id
            ORDER BY cm.joined_at ASC
            LIMIT :lim
        ");
        $stmt->bindValue(':id', (int)$clubId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add full name and avatar
        foreach ($members as &$m) {
            $m['full_name'] = $m['first_name'] . ' ' . $m['last_name'];
            $m['avatar_url'] = 'https://ui-avatars.com/api/?name=' . urlencode($m['full_name']);
        }

        return $members;
    }

    /**
     * Get events for a club
     */
    public static function getEvents($clubId, $limit = 3)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            SELECT id, title, description, event_date, location
            FROM events
            WHERE club_id = :id
            ORDER BY event_date DESC
            LIMIT :lim
        ");
        $stmt->bindValue(':id', (int)$clubId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add formatted date parts
        foreach ($events as &$e) {
            $ts = strtotime($e['event_date']);
            $e['month'] = date('M', $ts);
            $e['day'] = date('d', $ts);
        }

        return $events;
    }

    /**
     * Get articles for a club
     */
    public static function getArticles($clubId, $limit = 3)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            SELECT id, title, image_url, created_at
            FROM articles
            WHERE club_id = :id
            ORDER BY created_at DESC
            LIMIT :lim
        ");
        $stmt->bindValue(':id', (int)$clubId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add formatted date
        foreach ($articles as &$a) {
            $a['date_text'] = date('F j, Y', strtotime($a['created_at']));
        }

        return $articles;
    }

    /**
     * Get president data for a club
     */
    public static function getPresident($club)
    {
        if (empty($club['president_id'])) {
            return null;
        }
        $fullName = trim(($club['president_first_name'] ?? '') . ' ' . ($club['president_last_name'] ?? ''));

        return [
            'id' => (int)$club['president_id'],
            'full_name' => $fullName ?: 'Club President',
            'email' => $club['president_email'] ?? '',
            'avatar_url' => 'https://ui-avatars.com/api/?name=' . urlencode($fullName ?: 'President'),
            'subtitle' => 'President',
            'quote' => 'Feel free to reach out about membership!',
        ];
    }

    /**
     * Get the club ID that a student belongs to
     */
    public static function getUserClubId($studentId)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            SELECT club_id
            FROM club_members
            WHERE student_id = :sid
            LIMIT 1
        ");
        $stmt->execute(['sid' => (int)$studentId]);
        return $stmt->fetchColumn() ?: null;
    }

    /**
     * Check if club exists
     */
    public static function exists($clubId)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("SELECT id FROM clubs WHERE id = :id");
        $stmt->execute(['id' => (int)$clubId]);
        return (bool)$stmt->fetch();
    }

    /**
     * Add a student to a club
     */
    public static function addMember($clubId, $studentId)
    {
        $pdo = Config::getPDO();
        try {
            $stmt = $pdo->prepare("
                INSERT INTO club_members (club_id, student_id)
                VALUES (:club_id, :student_id)
            ");
            return $stmt->execute([
                'club_id' => (int)$clubId,
                'student_id' => (int)$studentId
            ]);
        } catch (PDOException $e) {
            // Duplicate entry or constraint violation
            return false;
        }
    }

    /**
     * Create a new club
     */
    public static function create($data)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO clubs (name, description, president_id)
            VALUES (:name, :description, :president_id)
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'president_id' => $data['president_id'] ?? null
        ]);
    }

    /**
     * Update a club
     */
    public static function update($id, $data)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("
            UPDATE clubs
            SET name = :name,
                description = :description,
                president_id = :president_id
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => (int)$id,
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'president_id' => $data['president_id'] ?? null
        ]);
    }

    /**
     * Delete a club
     */
    public static function delete($id)
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("DELETE FROM clubs WHERE id = :id");
        return $stmt->execute(['id' => (int)$id]);
    }

    /**
     * Get club by president ID
     */
    public function getClubByPresident(int $presidentId)
    {
        $sql = "SELECT * FROM clubs WHERE president_id = :president_id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['president_id' => $presidentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get a single club by ID
     */
    public static function getClubById($id): array|false
    {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM clubs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}