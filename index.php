<?php
/**
 * 前台同一入口文件.
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-10
 * Time: 下午15:07
 * Blog http://www.lanecn.com
 */

//管理员
if(preg_match('#/admin.php/#', $_SERVER['REQUEST_URI'])){
    // 定义控制器目录
    $GLOBALS['CONTROL_PATH'] = 'admin/';
    // 载入初始化框架文件
    require_once 'core/init.php';
    // 初始化应用程序
    APP::init();
    // 处理当前HTTP请求
    APP::adminRequest();
//普通用户
}else{
    // 定义控制器目录
    $GLOBALS['CONTROL_PATH'] = 'apis/';
    // 载入初始化框架文件
    require_once 'core/init.php';
    // 初始化应用程序
    APP::init();
    // 处理当前HTTP请求
    APP::normalRequest();
}
?>

