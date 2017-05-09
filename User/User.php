<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$
/*
 * 菜鸟教程 RESTful 演示实例
 * RESTful 服务类
*/
require_once('../Base/MySQL.php');
Class User {
    private $users = array();
    public function getAllUsers() {
        $user_sql = "select * from strun_userinfo";
        $mysql = new MySQL();
        $user_res = $mysql -> linkSql($user_sql);
        $field_count=mysqli_num_fields($user_res);
        $usertemp = mysqli_fetch_all($user_res);
        $userlist = array();
        foreach($usertemp as $key => $value) {
            // print_r($value);
            $temp = array();
            for ($i = 0;$i < $field_count; ++$i) {
                $field_info = mysqli_fetch_field_direct($user_res, $i);
                // print_r($field_info -> name);
                $subkey = str_replace('_', '', strtolower($field_info->name));
                $subtemp = array(
                    $subkey => $value[$i]
                );
                $temp = array_merge($temp, $subtemp);
            }
            array_push($userlist, $temp);
        }
        // $test = $field_info -> name;
        // print_r(str_replace('_', '', strtolower($test)));
        // $temp = array();
        // foreach($user[0] as $key => $value) {
        //     $temp[$key] = $value;
        //     print_r($temp);
        // }
        // print_r(json_encode($usertemp));
        $this->users = $userlist;
        return $this->users;
    }
    public function getUser($id) {
        $user = array(
            $id => ($this->users[$id]) ? $this->users[$id] : $this->users[1]
        );
        return $user;
    }
}
?>
