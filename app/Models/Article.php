<?php

class Article{
  private $id;

  public static function getArticle($articleId){

        $pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "select * , articles.event_id as event from articles left join events on events.id = articles.event_id left join reviews on reviews.event_id = events.id where articles.id = :article_id"
        );
        $stmt->execute(["article_id" => $articleId]);
        $result = $stmt->fetch();
      return $result;

  }

}
