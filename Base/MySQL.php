<?php 
class MySQL{
    //mysql
    
  function linkSql ($sql) {
    $local = "qdm169152214.my3w.com:3306";
    $user = "qdm169152214";
    $pwd = "loveqin277";
    $dbname = "qdm169152214_db";
    //connect
    $con = mysqli_connect($local,$user,$pwd);
      
    //select db
    mysqli_select_db($con, $dbname); 
    mysqli_query($con, "alter database qdm169152214_db character set utf8");
    mysqli_query($con, "set names utf8");
    $sql_res = mysqli_query($con, $sql);
    mysqli_close($con);
    return $sql_res;
  }
}
?>