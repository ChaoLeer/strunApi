<?php
  // 登录
        //header('Access-Control-Allow-Origin:*');
// header('Access-Control-Allow-Origin', '*');
// header("Access-Control-Max-Age: 86400");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// header("Access-Control-Allow-Methods: OPTIONS, GET, PUT, POST, DELETE");
// header("ACCESS-CONTROL-ALLOW-ORIGIN:*");
  require_once ("../Base/PubFun.php");
  require_once ("ArticleHandler.php");
  if(isset($_POST['userid'])
    &&isset($_POST['articleid'])
    &&isset($_POST['title'])
    &&isset($_POST['author'])
    &&isset($_POST['articleintro'])
    &&isset($_POST['content'])
    &&isset($_POST['classify'])
  ) {
    $articleid = $_POST['articleid'];
    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $classify = $_POST['classify'];
  	if (!get_magic_quotes_gpc()) {
  		$content=addslashes($_POST['content']);
  		$articleintro=addslashes($_POST['articleintro']);
  	} else {
  		$content=$_POST['content' ];
  		$articleintro=$_POST['articleintro' ];
      echo "string";
  	}
    $articleRestHandler = new ArticleHandler();
    $articleRestHandler->updateArticle($articleid, $userid, $title,$author, $articleintro,$content, $classify);
  } else {
    $message = array(
      'message' => '数据提交有误'
    );
    $rest = new PubFun();
    $rest->responseUpdateResult(false, $message);
    // echo json_encode($message);
  };

?>
