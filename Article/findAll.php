<?php
  // 查找所有文章
        // header('Access-Control-Allow-Origin:*');
  // header("ACCESS-CONTROL-ALLOW-ORIGIN:*");
  require_once ("ArticleHandler.php");
    // $articleid = $_POST['articleid'];
        // echo "*****************************";
  $articleRestHandler = new ArticleHandler();
  $articleRestHandler->getAllArticles();

 ?>