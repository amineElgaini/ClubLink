<?php
    class Club {
        private $nom;
        private $prisedent;
        private $membre;
        private $description;
        
        public function createClub(){}

        public static function getAllClubs(): array {
            $pdo = Config::getPDO();

            $sql = "SELECT * FROM clubs";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function modifierClub(){}

        public function supprimerClub(){}
    }