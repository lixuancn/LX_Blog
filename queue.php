<?php
/**
 * 队列同一入口文件.
 * @author：LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-8-31 
 * @version $Id: queue.php 2 2013-06-05 10:21:56Z manling $
 */

// 定义入口名称
//define('ENTRY_NAME', 'queue');

// 定义控制器目录
define('CONTROL_PATH', 'queue/');

// 载入初始化框架文件
require_once 'core/init.php';

// 初始化应用程序
APP::init();

// 初始化应用程序
APP::queueRequest();
?>