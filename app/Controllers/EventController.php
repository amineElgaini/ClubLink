<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Club.php';
require_once __DIR__ . '/../Models/Events.php';
require_once __DIR__ . '/../Models/Evenement.php';
require_once __DIR__ . '../../config/database.php';

class EventController extends Controller
{
    /**
     * List all events
     */
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            die('Session utilisateur inexistante');
        }

        $userId = $_SESSION['user']->id ?? $_SESSION['user']['id'];
        $role = $_SESSION['user']->role ?? $_SESSION['user']['role'];

        if ($role !== 'president') {
            echo 'Accès refusé';
            exit;
        }

        $db = Config::getPDO();
        $eventModel = new Evenement($db);
        $clubModel = new Club($db);

        $club = $clubModel->getClubByPresident($userId);

        if (!$club) {
            echo 'Aucun club trouvé pour ce président';
            exit;
        }

        $events = $eventModel->getEventsByClub($club['id']);

        include __DIR__ . '/../Views/president/manage-event.php';
    }

    /**
     * Student registers for event
     */
    public function register($id = null)
    {
        // Handle both student registration and event creation
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id === null) {
            // President creating new event
            $db = Config::getPDO();
            $eventModel = new Evenement($db);
            $clubModel = new Club($db);

            $userId = $_SESSION['user']->id ?? $_SESSION['user']['id'];
            $club = $clubModel->getClubByPresident($userId);
            
            if (!$club) {
                die('Aucun club trouvé');
            }

            $eventModel->createEvent([
                'club_id' => $club['id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'event_date' => $_POST['event_date'],
                'location' => $_POST['location'],
                'image_url' => $_POST['image_url'] ?? null
            ]);

            header('Location: /events');
            exit;
        } elseif ($id !== null) {
            // Student registering for event
            if (isset($_SESSION['id'])) {
                Events::inscrire($id, $_SESSION['id']);
            }
        }
    }

    /**
     * Update event (president)
     */
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $db = Config::getPDO();
        $eventModel = new Evenement($db);

        $eventModel->updateEvent($id, [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'event_date' => $_POST['event_date'],
            'location' => $_POST['location'],
            'image_url' => $_POST['image_url'] ?? null
        ]);

        header('Location: /events');
        exit;
    }

    /**
     * Delete event (president)
     */
    public function destroy($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $db = Config::getPDO();
        $clubModel = new Club($db);
        $eventModel = new Evenement($db);

        $userId = $_SESSION['user']->id ?? $_SESSION['user']['id'];
        $club = $clubModel->getClubByPresident($userId);
        
        if (!$club) {
            die('Aucun club trouvé');
        }

        $event = $eventModel->getEventById($id);
        
        if (!$event || $event['club_id'] != $club['id']) {
            die('Suppression interdite');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventModel->deleteEvent($id);
            header('Location: /events');
            exit;
        }
    }

    /**
     * View participants for an event
     */
    public function participants(int $eventId): void
    {
        $db = Config::getPDO();
        $eventModel = new Evenement($db);
        $clubModel = new Club($db);

        $userId = $_SESSION['user']->id ?? $_SESSION['user']['id'];
        $club = $clubModel->getClubByPresident($userId);
        
        if (!$club) {
            die('Aucun club trouvé');
        }

        $event = $eventModel->getEventById($eventId);
        
        if (!$event || $event['club_id'] != $club['id']) {
            die('Action interdite');
        }

        $participants = $eventModel->getParticipants($eventId);
        include __DIR__ . '/../Views/president/participants.php';
    }
}