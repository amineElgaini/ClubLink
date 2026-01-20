<?php
class Club {
    private $name;
    private $president_id;
    private $description;

    public function __construct($name = null, $description = null, $president_id = null) {
        $this->name = $name;
        $this->description = $description;
        $this->president_id = $president_id;
    }

    // Create a new club
    public function createClub(): bool {
        try {
            $pdo = Config::getPDO();
            $sql = "INSERT INTO clubs (name, description, president_id) VALUES (:name, :description, :president_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':president_id', $this->president_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            if (class_exists('Logger')) Logger::error($e->getMessage());
            return false;
        }
    }

    // Update existing club
    public static function updateClub($id, $name, $description, $president_id = null): bool {
        try {
            $pdo = Config::getPDO();
            $sql = "UPDATE clubs SET name = :name, description = :description, president_id = :president_id WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':president_id', $president_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            if (class_exists('Logger')) Logger::error($e->getMessage());
            return false;
        }
    }

    // Delete a club
    public static function deleteClub($id): bool {
        try {
            $pdo = Config::getPDO();
            $sql = "DELETE FROM clubs WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            if (class_exists('Logger')) Logger::error($e->getMessage());
            return false;
        }
    }

    // Get all clubs
    public static function getAllClubs(): array {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM clubs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single club by ID
    public static function getClubById($id): array|false {
        $pdo = Config::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM clubs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
