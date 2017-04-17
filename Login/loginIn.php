<?php 
  //设置编码为UTF-8
  // header("Content-Type:application/json;charset=UTF-8"); 
  // //处理跨域  
  // header("Access-Control-Allow-Origin: *"); 
  // //*号表示所有域名都可以访问  
  // header("Access-Control-Allow-Method: POST,GET");  
  // echo "login";
  if($_POST){
    $username = trim($_POST['username']);
    // $password = md5(trim($_POST['password']));
    $password = trim($_POST['password']);
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($username == "lichao" && $password == "loveqin") {
      echo "login success!";
    } else {
      echo "login faild!";
    }
  }
?>