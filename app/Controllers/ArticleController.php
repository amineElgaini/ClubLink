<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';
// app/Controllers/ArticleController.php
class ArticleController extends Controller {
  public function show($clubId, $articleId) {
      $result = Article::getArticle(3);
      $this->view('student/show-article', ['result' => $result]);
  }             
    public function comment($clubId, $articleId) {}             
    public function create() {}                                
    public function store() {}                                
}
