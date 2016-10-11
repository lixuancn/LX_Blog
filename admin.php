<?php
/**
 * 后台同一入口文件.
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-2
 * Time: 下午3:52
 * Blog http://www.lanecn.com
 */
// 定义入口名称
!defined('ENTRY_NAME') ? define('ENTRY_NAME', 'admin') : null;

// 定义控制器目录
!defined('CONTROL_PATH') ? define('CONTROL_PATH', 'admin/') : null;

// 载入初始化框架文件
require_once 'core/init.php';

// 初始化应用程序
APP::init();

// 处理当前HTTP请求
APP::adminRequest();
?>
