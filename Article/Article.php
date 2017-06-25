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
 * RESTful
 * RESTful 服务类
*/
require_once('../Base/MySQL.php');
Class Article {
    private $articles = array();
    private $article_types = array(
        array(
          "type"=> "HTML",
          "value"=> "HTML"
        ),
        array(
          "type"=> "PHP",
          "value"=> "PHP"
        ),
        array(
          "type"=> "JS",
          "value"=> "JS"
        ),
        array(
          "type"=> "CSS",
          "value"=> "CSS"
        ),
        array(
          "type"=> "Vue",
          "value"=> "Vue"
        ),
        array(
          "type"=> "Weex",
          "value"=> "Weex"
        ),
        array(
          "type"=> "Linux",
          "value"=> "Linux"
        ),
        array(
          "type"=> "React",
          "value"=> "React"
        )
    );
    // 获取所有文章列表
    public function getAllArticles() {
        $user_sql = "SELECT ARTICLE_ID,AUTHOR,CLASSIFY,TITLE,ARTICLE_INTRO,USER_ID,CREATE_DATE FROM strun_article ORDER BY CREATE_DATE DESC";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $user_list_temp = $mysql -> getDatas($con, $user_sql);
        // echo "****************()(((********************";
		    // print_r($user_list_temp);
        $this->articles = $user_list_temp;
        return $user_list_temp;
    }
    // 分页获取
    public function getAllArticleListByPage($page,$userId,$articleType,$searchInfo) {
      $start = ($page-1)*10;
      $end = $page*10;
      $term = "WHERE";
      if (!empty($userId)) {
        $term = $term." USER_ID='".$userId."' ";
      }
      if (!empty($articleType)) {
        if (!empty($userId) || !empty($searchInfo)) {
          $term = $term." AND";
        }
        $term = $term." CLASSIFY='".$articleType."' ";
      }
      if (!empty($searchInfo)) {
        if (!empty($userId) || !empty($articleType)) {
          $term = $term." AND";
        }
        $term =$term." TITLE LIKE '%".$searchInfo."%' OR CLASSIFY LIKE '%".$searchInfo."%' ";
      }
      if ($term == "WHERE") {
        $term = "";
      }
      // echo $term;
      $get_sql = "SELECT ARTICLE_ID,AUTHOR,CLASSIFY,TITLE,ARTICLE_INTRO,USER_ID,CREATE_DATE FROM strun_article ".$term." ORDER BY CREATE_DATE DESC LIMIT ".$start.",".$end;
      // echo $get_sql;
      $mysql = new MySQL();
      $con = $mysql -> connectSQL();
      $user_list_temp = $mysql -> getDatas($con, $get_sql);
      // echo "****************()(((********************";
      // print_r($user_list_temp);
      $this->articles = $user_list_temp;
      return $user_list_temp;
    }
    // 通过文章id查文章
    public function getArticleByArticleId($id) {
        $article_sql = "SELECT * from strun_article WHERE ARTICLE_ID='".$id."'";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $article_list_temp = $mysql -> getSingleDatas($con, $article_sql);
        $this->articles = $article_list_temp;
        return $this->articles;
    }
    // 通过用户id查文章列表
    public function getArticleListByUserId($id) {
        $article_sql = "SELECT ARTICLE_ID,AUTHOR,CLASSIFY,TITLE,ARTICLE_INTRO,USER_ID,CREATE_DATE from strun_article WHERE USER_ID='".$id."' ORDER BY CREATE_DATE DESC";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $article_list_temp = $mysql -> getDatas($con, $article_sql);
        $this->articles = $article_list_temp;
        return $this->articles;
    }
    // 搜索文章
    public function searchArticle($searchInfo) {
        $article_sql = "SELECT ARTICLE_ID,AUTHOR,CLASSIFY,TITLE,ARTICLE_INTRO,USER_ID,CREATE_DATE FROM strun_article WHERE TITLE LIKE '%".$searchInfo."%' OR CLASSIFY LIKE '%".$searchInfo."%' ORDER BY CREATE_DATE DESC";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $article_list_temp = $mysql -> getDatas($con, $article_sql);
        $this->articles = $article_list_temp;
        return $this->articles;
    }
    // 获取文章分类
    public function getArticleType(){
      return $this->article_types;
    }
    // 新增文章
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
    // 更新修改文章
    public function updateArticle($articleid,$userid, $title,$author, $articleintro,$content, $classify) {
		// print_r($content);

        $update_sql = "UPDATE `strun_article`
                      SET `TITLE`='".$title."',
                        `CONTENT`='".$content."',
                        `ARTICLE_INTRO`='".$articleintro."',
                        `CLASSIFY`='".$classify."' WHERE `ARTICLE_ID`='".$articleid."'";
        $mysql = new MySQL();
        $con = $mysql -> connectSQL();
        $update_res = $mysql -> update($con, $update_sql);
        echo $update_res;
        return $update_res;
    }
}
?>
