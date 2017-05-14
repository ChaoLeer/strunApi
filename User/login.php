<?php
  // 登录
        // header('Access-Control-Allow-Origin:*');
  require_once ("UserHandler.php");
  if(isset($_POST['loginname']) && isset($_POST['password'])) {
    $loginname = $_POST['loginname'];
    $password = $_POST['password'];
    $userRestHandler = new UserHandler();
    $userRestHandler->login($loginname, $password);
  } else {
    $message = array(
      'message' => '请求错误'
    );
    echo json_encode($message);
  };

 ?>