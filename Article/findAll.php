<?php
  // 查找所有文章
        // header('Access-Control-Allow-Origin:*');
  require_once ("ArticleHandler.php");
    // $articleid = $_POST['articleid'];
  $articleRestHandler = new ArticleHandler();
  $articleRestHandler->getAllArticles();

 ?>