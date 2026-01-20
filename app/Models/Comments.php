<?php 

class Comments{

  public static function showComments($eventId){
$pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "select * from reviews left join students on students.id = reviews.student_id where event_id = :event_id"
        );
        $stmt->execute(['event_id' => $eventId ]);
        $result = $stmt->fetchAll();
      return $result;
  }
  public static function newComment(){
       $stmt = $pdo->prepare(
            "insert into reviews()"
        );
        $stmt->execute(['event_id' => $eventId ]);
  
  }

}
