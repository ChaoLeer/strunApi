<?php
  // 文章id查找文章
  header('Access-Control-Allow-Origin:*');
  require_once ("ArticleHandler.php");
  if(isset($_POST['articleid'])) {
    $articleid = $_POST['articleid'];
    // $articleid = $_POST['articleid'];
    $articleRestHandler = new ArticleHandler();
    $articleRestHandler->getArticleByArticleId($articleid);
  } else {
    $message = array(
      'message' => '请求错误'
    );
    echo json_encode($message);
  };

 ?>