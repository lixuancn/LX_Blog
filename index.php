<?php
/**
 * 前台同一入口文件.
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-10
 * Time: 下午15:07
 * Blog http://www.lanecn.com
 */
// 定义入口名称
define('ENTRY_NAME', 'index');

// 定义控制器目录
define('CONTROL_PATH', 'apis/');

// 载入初始化框架文件
require_once 'core/init.php';

// 初始化应用程序
APP::init();

// 处理当前HTTP请求
APP::normalRequest();
