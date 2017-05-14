<?php 
  /**
  获取所有用户列表
  */
  require_once ("UserHandler.php");

  $userRestHandler = new UserHandler();
  $userRestHandler->getAllUsers();
?>