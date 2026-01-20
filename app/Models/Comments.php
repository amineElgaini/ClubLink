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
  public static function newComment($eventId,$studentId,$rating,$comment){
$pdo = Config::getPDO();
       $stmt = $pdo->prepare(
            "insert into reviews(event_id,student_id,rating,comment) values(:event_id,:student_id,:rating,:comment)"
        );
    $stmt->execute([
      'event_id' => $eventId,
      'student_id' => $studentId,
      'rating' => $rating,
      'comment' => $comment
    ]);
  }

}
