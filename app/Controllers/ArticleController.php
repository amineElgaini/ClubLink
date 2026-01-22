<?php
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Comments.php';
require_once __DIR__ . '/../Models/User.php';
// app/Controllers/ArticleController.php
class ArticleController extends Controller {
      public function show($id)
  {
    //article
    $result = Article::getArticle($id);
    
    // printf($id);
    //comments
    $comments = Comments::showComments($result['event']);
    //view
    $arr = [];
    $arr['article'] = $result;
    $arr['comments'] = $comments;
    $this->view('student/evenements', ['result' =>  $result, 'comment' => $comments]);
  }

  public function comment($id)
  {
    //to get event id
    $result = Article::getArticle($id);
    $comments = Comments::showComments($result['event']);

    $comment = $_POST['review'];
    $rating = $_POST['rating'];
    $eventId = $result['event'];
    Comments::newComment($eventId, $_SESSION['id'], $rating, $comment);
  }

    public function create()
    {
        // Must be logged in
        if (empty($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login to create an article.';
            header('Location: ../login');
            exit;
        }

        $pdo = Config::getPDO();
        $user = $_SESSION['user'];

        // Get clubs that the user can create articles for
        if ($user->isAdmin()) {
            // Admin can create for any club
            $stmt = $pdo->query("SELECT id, name FROM clubs ORDER BY name ASC");
            $clubs = $stmt->fetchAll();
        } else {
            // President can only create for their club(s)
            $stmt = $pdo->prepare("
                SELECT id, name 
                FROM clubs 
                WHERE president_id = :pid 
                ORDER BY name ASC
            ");
            $stmt->execute(['pid' => (int)$user->id]);
            $clubs = $stmt->fetchAll();
        }

        // If user is not admin and not president of any club, deny access
        if (empty($clubs)) {
            $_SESSION['error'] = 'Only a club president (or admin) can create articles.';
            header('Location: /clubs');
            exit;
        }

        // Get selected club (from query param or first available)
        $allowedClubIds = array_map(fn($c) => (int)$c['id'], $clubs);
        $selectedClubId = isset($_GET['club_id']) ? (int)$_GET['club_id'] : $allowedClubIds[0];

        // Validate selected club
        if (!in_array($selectedClubId, $allowedClubIds, true)) {
            $selectedClubId = $allowedClubIds[0];
        }

        // Get club details
        $stmt = $pdo->prepare("SELECT * FROM clubs WHERE id = :id");
        $stmt->execute(['id' => $selectedClubId]);
        $club = $stmt->fetch();

        // Get ONLY PAST events for this club (event_date < current date)
        $stmt = $pdo->prepare("
            SELECT id, title, event_date, location, description
            FROM events
            WHERE club_id = :cid AND event_date < CURRENT_DATE
            ORDER BY event_date DESC
        ");
        $stmt->execute(['cid' => $selectedClubId]);
        $events = $stmt->fetchAll();

        // Format events with readable dates
        foreach ($events as &$e) {
            $e['formatted_date'] = date('F j, Y', strtotime($e['event_date']));
        }
        unset($e);

        // Select first event or from query param
        $selectedEventId = isset($_GET['event_id']) ? (int)$_GET['event_id'] : null;
        if ($selectedEventId === null && !empty($events)) {
            $selectedEventId = (int)$events[0]['id'];
        }

        // Get selected event details
        $event = null;
        if ($selectedEventId) {
            foreach ($events as $e) {
                if ((int)$e['id'] === $selectedEventId) {
                    $event = $e;
                    break;
                }
            }
        }

        // If no event found, create empty placeholder
        if (!$event) {
            $event = [
                'id' => 0,
                'title' => 'No past events available',
                'event_date' => date('Y-m-d'),
                'formatted_date' => 'N/A',
                'location' => 'N/A',
                'description' => ''
            ];
        }

        // Default empty article data
        $article = [
            'title' => '',
            'content' => '',
            'image_url' => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=1200&h=500&fit=crop'
        ];

        // Prepare view variables
        $title = "Create Article - " . $club['name'];
        $basePath = '/ClubLink';
        $userAvatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($user->fullName());
        $dashboardHref = '/clubs';
        $clubHref = '/clubs/' . $selectedClubId;
        $eventDateText = $event['formatted_date'];

        // Render view
        require __DIR__ . '/../Views/president/article-form.php';
    }

    /**
     * Store new article
     */
    public function store()
    {
        // Must be logged in
        if (empty($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login to create articles.';
            header('Location: /login');
            exit;
        }

        $user = $_SESSION['user'];

        // Validate required fields
        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['club_id'])) {
            $_SESSION['error'] = 'Please fill in all required fields.';
            header('Location: /articles/create');
            exit;
        }

        // Verify user has permission for this club
        $pdo = Config::getPDO();
        
        if (!$user->isAdmin()) {
            $stmt = $pdo->prepare("SELECT id FROM clubs WHERE id = :cid AND president_id = :pid");
            $stmt->execute([
                'cid' => (int)$_POST['club_id'],
                'pid' => (int)$user->id
            ]);
            
            if (!$stmt->fetch()) {
                $_SESSION['error'] = 'You do not have permission to create articles for this club.';
                header('Location: /clubs');
                exit;
            }
        }

        // Create article
        $articleId = Article::create($_POST);

        if ($articleId) {
            $_SESSION['success'] = 'Article published successfully!';
            header('Location: /clubs/' . (int)$_POST['club_id']);
        } else {
            $_SESSION['error'] = 'Failed to create article.';
            header('Location: /articles/create');
        }
        exit;
    }                                   // save new article
}
