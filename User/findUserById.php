<?php  
  //用id查找用户 
  require_once ("UserHandler.php");

  $userRestHandler = new UserHandler();
  $userRestHandler->getUser($_GET["id"]);
?>