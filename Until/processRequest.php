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

public static function processRequest() {
    // get our verb 获取动作
    $request_method = strtolower($_SERVER['REQUEST_METHOD']);
    $return_obj = new RestRequest();
    // we'll store our data here 在这里存储请求数据
    $data = array();
    switch ($request_method) {
            // gets are easy...
            
        case 'get':
            $data = $_GET;
            break;
            // so are posts
            
        case 'post':
            $data = $_POST;
            break;
            // here's the tricky bit...
            
        case 'put':
            // basically, we read a string from PHP's special input location,
            // and then parse it out into an array via parse_str... per the PHP docs:
            // Parses str  as if it were the query string passed via a URL and sets
            // variables in the current scope.
            parse_str(file_get_contents('php://input') , $put_vars);
            $data = $put_vars;
            break;
    }
    // store the method
    $return_obj->setMethod($request_method);
    // set the raw data, so we can access it if needed (there may be
    // other pieces to your requests)
    $return_obj->setRequestVars($data);
    if (isset($data['data'])) {
        // translate the JSON to an Object for use however you want
        $return_obj->setData(json_decode($data['data']));
    }
    return $return_obj;
}
?>
