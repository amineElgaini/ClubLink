<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Comments.php';

class ArticleController extends Controller {
  public function show($id ) {
    //article
      $result = Article::getArticle($id);
    //comments
      $comments = Comments::showComments($result['event']);
    //view
       $arr =[];
      $arr['article'] = $result;
      $arr['comments'] = $comments;
      $this->view('student/show-article', ['result' =>  $result, 'comment' =>$comments]);
  }
  //ajouter comments
  public function comment($id) {

  }             
    public function create() {}                                
    public function store() {}                                
}
