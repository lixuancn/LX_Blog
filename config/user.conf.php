<?php
/**
 * 用户自定义配置参数.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-5-11 
 * @version $Id: user.conf.php 1 2013-05-30 06:40:35Z manling $
 */

//用户组的系统标识
$UCONF['GROUP_IS_SYSTEM'] = array(
	0 => '系统',
	1 => '普通',
);
//管理员的状态
$UCONF['ADMIN_STATUS'] = array(
	0 => '已删除',
	1 => '使用中',
	2 => '超级管理员',
);
//导航菜单链接目标
$UCONF['TARGET'] = array(
	'mainFrame' => '内容Frame',
	'menuFrame' => '菜单Frame',
	'_blank' => '新窗口',
	'_self' => '当前框架',
	'_parent' => '父框架',
	'_top' => '整个窗口',
);
$UCONF['NAV_TYPE'] = array(
	'0' => '链接',
	'1' => '菜单',
);
//列表容量
$UCONF['PAGESIZE'] = array(
	10 => '10',
	20 => '20',
	50 => '50',
	100 => '100',
);
?>