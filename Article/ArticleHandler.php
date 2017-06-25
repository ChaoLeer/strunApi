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

// header('Access-Control-Allow-Origin:*');
require_once ("../Base/PubFun.php");
require_once ("Article.php");
class ArticleHandler extends Rest {
    // 获取所有文章列表
    public function getAllArticles() {
        $articles = new Article();
        $rawData = $articles->getAllArticles();
        $pubfun = new PubFun();
        $notFoundRes = array(
            'error' => 'No articless found!'
        );
        $pubfun -> responseDatas($rawData, $notFoundRes);
    }
    // 分页获取
    public function getAllArticleListByPage($page,$userId,$classify,$searchInfo) {
      $articles = new Article();
      $rawData = $articles->getAllArticleListByPage($page,$userId,$classify,$searchInfo);
      $pubfun = new PubFun();
      $notFoundRes = array(
          'error' => 'No articless found!'
      );
      $pubfun -> responseDatas($rawData, $notFoundRes);
    }
    // 通过文章id查文章
    public function getArticleByArticleId($id) {
        $articles = new Article();
        $rawData = $articles->getArticleByArticleId($id);
        $pubfun = new PubFun();
        $notFoundRes = array(
            'error' => 'No articless found!'
        );
        $pubfun -> responseDatas($rawData, $notFoundRes);
    }
    // 通过用户id查文章列表
    public function getArticleListByUserId($id) {
        $articles = new Article();
        $rawData = $articles->getArticleListByUserId($id);
        $pubfun = new PubFun();
        $notFoundRes = array(
            'error' => 'No articless found!'
        );
        $pubfun -> responseDatas($rawData, $notFoundRes);
    }
    // 搜索文章
    public function searchArticle($searchInfo) {
        $articles = new Article();
        $rawData = $articles->searchArticle($searchInfo);
        $pubfun = new PubFun();
        $notFoundRes = array(
            'error' => '没有搜索结果!'
        );
        $pubfun -> responseDatas($rawData, $notFoundRes);
    }
    // 获取文章分类
    public function getArticleType(){
        $articletypes = new Article();
        $updateResult = $articletypes->getArticleType();
        // echo ($updateResult);
        $pubfun = new PubFun();
        $pubfun -> responseArticleTypesResult($updateResult);
    }
    // 新增文章
    public function insertArticle($userid, $title,$author, $articleintro,$content, $classify) {
        $articles = new Article();
        $insertResult = $articles->insertArticle($userid, $title,$author, $articleintro,$content, $classify);
        // echo ($insertResult);
        $pubfun = new PubFun();
        $notFoundRes = array(
            'message' => '提交失败！'
        );
        $pubfun -> responseInsertResult($insertResult, $notFoundRes);
    }
    // 更新修改文章
    public function updateArticle($articleid,$userid, $title,$author, $articleintro,$content, $classify) {
        $articles = new Article();
        $updateResult = $articles->updateArticle($articleid,$userid, $title,$author, $articleintro,$content, $classify);
        // echo ($updateResult);
        $pubfun = new PubFun();
        $notFoundRes = array(
            'message' => '提交失败！'
        );
        $pubfun -> responseUpdateResult($updateResult, $notFoundRes);
    }
}
?>
