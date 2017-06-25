<?php
  // 用户id查找文章列表
  // header('Access-Control-Allow-Origin:*');
  require_once ("ArticleHandler.php");
  if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    // $userid = $_POST['userid'];
    $userRestHandler = new ArticleHandler();
    $userRestHandler->getArticleListByUserId($userid);
  } else {
    $message = array(
      'message' => '请求错误'
    );
    echo json_encode($message);
  };

 ?>
