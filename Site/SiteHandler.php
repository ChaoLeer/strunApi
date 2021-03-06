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

require_once ("../Base/PubFun.php");
require_once ("Site.php");
header('Access-Control-Allow-Origin:*');
$view = "";
if (isset($_GET["view"])) $view = $_GET["view"];
if (isset($_POST["view"])) $view = $_POST["view"];
// header('Access-Control-Allow-Origin:http://www.strun.club');
class SiteHandler extends Rest {
    function getAllSites() {
        $site = new Site();
        $rawData = $site->getAllSite();
        $pubfun = new PubFun();
        $notFoundRes = array(
            'error' => 'No sites found!'
        );
        $pubfun -> responseDatas($rawData, $notFoundRes);
    }
    public function getSite($id) {
        $site = new Site();
        $rawData = $site->getSite($id);
        $pubfun = new PubFun();
        $notFoundRes = array(
            'error' => 'No sites found!'
        );
        $pubfun -> responseDatas($rawData, $notFoundRes);
    }
}
?>
