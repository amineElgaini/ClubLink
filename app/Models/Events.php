<?php

class Events {

  public static function inscrire($eventId,$studentId){
      $pdo = Config::getPDO();
    $stmt = $pdo->prepare(
      "insert into event_participants(event_id,student_id,participated) values(:event_id,:student_id,:participated)"
    );
    $stmt->execute([
      'event_id' => $eventId,
      'student_id' => $studentId,
      'participated' => 't',
    ]);
  
  }

  public static function getEvents($id){

      $pdo = Config::getPDO();
    $stmt = $pdo->prepare(
      "select * from events where id = :id"
    );
    $stmt->execute([":id" => $id]);
    return $stmt->fetch();
    
  }

}
