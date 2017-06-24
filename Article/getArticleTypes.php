<?php
  /**
  *获取所有文章类型
  */
  require_once ("ArticleHandler.php");

  $articleRestHandler = new ArticleHandler();
  $articleRestHandler->getArticleType();
?>
