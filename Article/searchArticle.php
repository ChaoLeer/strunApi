<?php
  // 文章search
  // header('Access-Control-Allow-Origin:*');
  require_once ("ArticleHandler.php");
  if(isset($_POST['searchinfo'])) {
    $searchInfo = $_POST['searchinfo'];
    // $searchInfo = $_POST['articleid'];
    $articleRestHandler = new ArticleHandler();
    $articleRestHandler->searchArticle($searchInfo);
  } else {
    $message = array(
      'message' => '请求错误'
    );
    echo json_encode($message);
  };

 ?>
