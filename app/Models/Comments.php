<?php 

class Comments{

  public static function showComments($eventId){
$pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "select * from reviews where event_id = :event_id"
        );
        $stmt->execute(['event_id' => $eventId ]);
        $result = $stmt->fetchAll();
      return $result;
  }

}
