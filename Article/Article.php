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
Class Article {
    private $articles = array();
    public function getAllArticles() {
        $user_sql = "select * from strun_article";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $user_list_temp = $mysql -> getDatas($con, $user_sql);
        // echo "****************()(((********************";
		    // print_r($user_list_temp);
        $this->articles = $user_list_temp;
        return $user_list_temp;
    }
    public function getArticleByArticleId($id) {
        $article_sql = "SELECT * from strun_article WHERE ARTICLE_ID='".$id."'";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $article_list_temp = $mysql -> getSingleDatas($con, $article_sql);
        $this->articles = $article_list_temp;
        return $this->articles;
    }
    public function insertArticle($userid, $title,$author, $articleintro,$content, $classify) {
		// print_r($content);
		
        $insert_sql = "INSERT INTO `strun_article` (
                        `ARTICLE_ID`,
                        `AUTHOR`,
                        `USER_ID`,
                        `TITLE`,
                        `CONTENT`,
                        `CREATE_DATE`,
                        `ARTICLE_INTRO`,
                        `IS_LOCKED`,
                        `IS_DEL`,
                        `STAR`,
                        `FOLLOW`,
                        `TYPE`,
                        `CLASSIFY`,
                        `EXT1`,
                        `EXT2`,
                        `EXT3`
                      )
                      VALUES
                        (
                          (SELECT
                            REPLACE(UUID(),'-','')),
                            '".$author."',
                            '".$userid."',
                            '".$title."',
							'".$content."',
							(select now()),
                            '".$articleintro."',
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            NULL,
                            '".$classify."',
                            NULL,
                            NULL,
                            NULL
                        )";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $insert_res = $mysql -> insert($con, $insert_sql);
        return $insert_res;
    }
}
?>
