<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
// app/Controllers/ArticleController.php
class ArticleController extends Controller {
  public function show($clubId, $articleId) {
      $this->view('student/show-article.blade');
  }                 // show article
    public function comment($clubId, $articleId) {}             // comment on article
    public function create() {}                                  // show create article form
    public function store() {}                                   // save new article
}
