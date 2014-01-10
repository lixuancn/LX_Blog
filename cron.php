<?php
/**
 * CRON统一入口文件.
 * @author：LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-8-31 
 * @version $Id: cron.php 444 2013-08-26 02:46:43Z manling $
 */

// 定义入口名称
define('ENTRY_NAME', 'cron');

// 定义控制器目录
define('CONTROL_PATH', 'cron/');

// 载入初始化框架文件
require_once 'core/init.php';

// 初始化应用程序
APP::init();

// 初始化应用程序 TODO
if(WEB_SERVER!='develop' && WEB_SERVER!='test'){
	$argv = array();
}
//$argv = array();
APP::cronRequest($argv);

?>