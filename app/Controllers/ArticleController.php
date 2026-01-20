<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Comments.php';

class ArticleController extends Controller {
  public function show($clubId, $articleId) {
    //article
      $result = Article::getArticle($articleId);
    //comments
      $comments = Comments::showComments($result['event']);
    //view
       $arr =[];
      $arr['article'] = $result;
      $arr['comments'] = $comments;
      $this->view('student/show-article', ['result' =>  $result, 'comment' =>$comments]);
  }
    public function comment($clubId, $articleId) {}             
    public function create() {}                                
    public function store() {}                                
}
