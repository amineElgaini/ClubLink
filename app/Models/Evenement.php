<?php

class Evenement
{

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getEventById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEventsByClub(int $clubId)
    {
        
        $sql = "SELECT * FROM events 
                WHERE club_id = :club_id
                ORDER BY event_date DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['club_id' => $clubId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateEvent($id, array $data){
        
        $sql = "UPDATE events SET title = :title, description = :description, event_date = :event_date, location = :location, image_url = :image_url WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'event_date' => $data['event_date'],
            'location' => $data['location'],
            'image_url'=> $data['image_url'] ?? null,
            'id' => $id
        ]);
    }

    public function deleteEvent($id)
    {
        
        $sql = "DELETE FROM events WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
    }

    public function createEvent(array $data): void {
        $stmt = $this->db->prepare("INSERT INTO events (club_id, title, description, event_date, location, image_url) VALUES (:club_id, :title, :description, :event_date, :location, :image_url)");
        $stmt->execute([
            'club_id' => $data['club_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'event_date' => $data['event_date'],
            'location' => $data['location'],
            'image_url'=> $data['image_url']
        ]);
    }

    public function getParticipants(int $eventId): array {
        $stmt = $this->db->prepare("
            SELECT s.id, s.first_name, s.last_name, s.email
            FROM event_participants ep
            JOIN students s ON ep.student_id = s.id
            WHERE ep.event_id = :event_id
        ");
        $stmt->execute(['event_id' => $eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
