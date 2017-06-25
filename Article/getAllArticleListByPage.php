<?php
  // 分页查询文章列表
  // header('Access-Control-Allow-Origin:*');
  require_once ("ArticleHandler.php");
  if(isset($_POST['page'])) {
    $page = $_POST['page'];
    $userId = $_POST['userid'];
    $classify = $_POST['classify'];
    $searchInfo = $_POST['searchinfo'];
    // $userid = $_POST['userid'];
    $articleRestHandler = new ArticleHandler();
    $articleRestHandler->getAllArticleListByPage($page,$userId,$classify,$searchInfo);
  } else {
    $message = array(
      'message' => '请求错误'
    );
    echo json_encode($message);
  };

 ?>
