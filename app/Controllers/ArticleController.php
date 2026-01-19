<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// app/Controllers/ArticleController.php
class ArticleController extends Controller {
  public function show($clubId, $articleId) {
      $this->view('students/show_article');
  }                 // show article
    public function comment($clubId, $articleId) {}             // comment on article
    public function create() {}                                  // show create article form
    public function store() {}                                   // save new article
}
