<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Comments.php';

class ArticleController extends Controller
{
  public function show($id)
  {
    //article
    $result = Article::getArticle($id);
    //comments
    $comments = Comments::showComments($result['event']);
    //view
    $arr = [];
    $arr['article'] = $result;
    $arr['comments'] = $comments;
    $this->view('student/evenements', ['result' =>  $result, 'comment' => $comments]);
  }
  //ajouter comments
  public function comments($id)
  {
    //to get event id
    $result = Article::getArticle($id);
    $comments = Comments::showComments($result['event']);

    $comment = $_POST['review'];
    $rating = $_POST['rating'];
    $eventId = $result['event'];
    $studentId = $comments[0]['student'];
    echo $studentId;
    Comments::newComment($eventId, $studentId, $rating, $comment);
  }
  public function create() {}
  public function store() {}
}
