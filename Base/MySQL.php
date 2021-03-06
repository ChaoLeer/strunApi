<?php
require_once ("PubFun.php");
class MySQL{
  public $mysqlState = false;
  function connectSQL () {
    //部署时不带端口
   	$servername = "主机";
   	$username = "用户";
   	$password = "密码";
   	$dbname = "数据库";
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 检测连接
    if ($conn->connect_error) {
        $pubfun = new PubFun();
        $connectError = array(
            'error' => "mysql link error"
        );
        $pubfun -> responseMysqlError($connectError);
        $this->mysqlState = false;
        return false;
        // die("连接失败: " . $conn->connect_error);
    }
    $this->mysqlState = true;
    $conn -> set_charset('utf8');
  	// $sql = "SELECT * FROM strun_article";
  	// $result = $conn->query($sql);
  	// print_r($result);
    return $conn;
  }

  // 增加
  function insert ($conn, $sql) {
    if ($this->mysqlState) {
      if ($conn->query($sql) === TRUE) {
        return true;
      } else {
        echo $conn->error;
        return false;
      }
    }
    $conn->close();
  }

  // 增加多条数据 $sql使用$sql .= "INSERT INTO ;"连续赋值以分号分隔
  function insertMulti ($conn, $sql) {
    if ($this->mysqlState) {
      if ($conn->multi_query($sql) === TRUE) {
        // echo "增加成功";
        // return array(
        //   "message" => "增加成功！"
        // );
        return true;
      } else {
        return false;
      }
    }
    $conn->close();
  }

  // 查询单数据
  function getSingleDatas ($conn, $sql) {
    if ($this->mysqlState) {
      # code...
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $res = $this -> dpSingleDatas($result);
        // print_r($res);
        // print_r($res);
        // 输出数据
        return $res;
      } else {
        $message = array(
          'message' => '数据为空'
        );
        // echo json_encode($message);
        // echo "0 结果";
      }
    }
    $conn->close();
  }
  // 查询多条数据
  function getDatas ($conn, $sql) {
    if ($this->mysqlState) {
      // $result = $conn->query($sql);
      $result = mysqli_query($conn, $sql);
      if (!empty($result -> num_rows) && $result->num_rows > 0) {
        // print_r($result->fetch_assoc());
        $res = $this -> dpDatas($result);
        // 输出数据
        return $res;
      } else {
        $message = array(
          'message' => '数据为空'
        );
        // echo json_encode($message);
      }
    }
    $conn->close();
  }
  // 更新
  function update ($conn, $sql) {
    if ($this->mysqlState) {
      # code...
      $result = mysqli_query($conn, $sql);
      if ($result){
        return true;
        // $message = array(
        //   'message' => '更新操作执行成功'
        // );
        // echo json_encode($message);
      }else {
        echo $conn->error;
        return false;
        // $message = array(
        //   'message' => '更新操作执行失败'
        // );
        // echo json_encode($message);
      }
    }
    $conn->close();
  }

  // 删除
  function delete ($conn, $sql) {
    if (condition) {
      # code...
      $result = $conn->query($query);
      if ($result){
        $message = array(
          'message' => '删除操作执行成功'
        );
        echo json_encode($message);
      }else {
        $message = array(
          'message' => '删除操作执行失败'
        );
        echo json_encode($message);
      }
    }
    $conn->close();
  }

  // 处理单条数据，返回json数组
  function dpSingleDatas ($sql_res) {
    $field_count=mysqli_num_fields($sql_res);
    // $restemp = mysqli_fetch_all($sql_res)[0];
    $p_res = array();
    while($row = $sql_res->fetch_assoc()) {
      // print_r($row);
      array_push($p_res, $row);
    }
    $restemp = $p_res[0];
        // print_r($restemp);
    $p_res = array();
    // print_r($restemp);
    for ($i = 0;$i < $field_count; ++$i) {
        $temp = array();
        $field_info = mysqli_fetch_field_direct($sql_res, $i);
        // print_r($field_info -> name);
        $p_reskey = str_replace('_', '', strtolower($field_info->name));
        $temp = array(
            $p_reskey => $restemp[$field_info->name]
        );
        if ($p_reskey != 'password') {
          $p_res = array_merge($p_res, $temp);
        }
        // print_r($p_res);
    }
    // foreach($restemp as $key => $value) {
    //     // print_r($value);
    //     $temp = array();

    // }
    return $p_res;
  }
  // 处理多条数据，返回json数组
  function dpDatas ($sql_res) {
    $field_count=mysqli_num_fields($sql_res);
    // print_r($sql_res);
    // print_r(mysqli_fetch_fields($sql_res));
    $p_res = array();
    while($row = $sql_res->fetch_assoc()) {
      // print_r($row);
      array_push($p_res, $row);
    }
    $restemp = $p_res;
    $p_res = array();
    // print_r($p_res);
    // $restemp = mysqli_fetch_all($sql_res);
    // $p_res = array();
    foreach($restemp as $key => $value) {
        // print_r($value);
        $temp = array();
        for ($i = 0;$i < $field_count; ++$i) {
            $field_info = mysqli_fetch_field_direct($sql_res, $i);
            $subkey = str_replace('_', '', strtolower($field_info->name));
            // echo "*************************";
            // print_r($field_info);
            // echo "*************************";
            $subtemp = array(
                $subkey => $value[$field_info->name]
            );
            // if ($subkey != 'password') {
              $temp = array_merge($temp, $subtemp);
            // }
        }
        array_push($p_res, $temp);
    }
    return $p_res;
  }
}
?>
