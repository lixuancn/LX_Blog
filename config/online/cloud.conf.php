<?php
/**
 * SAE服务器配置文件.
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-5
 * Time: 下午4:44
 * Blog http://www.lanecn.com
 */
//数据库配置定义
define('DEFAULT_DB', 'blog');

//主从类数据库配置信息
$DATABASE = array(
	DEFAULT_DB => array(
		'master' => array(
            'host' => '127.0.0.1',
            'user' => 'lane',
            'password' => '123456',
            'port' => '3306',
			'db' => DEFAULT_DB,
		),
		'slave' => array(
			array(
                'host' => '127.0.0.1',
                'user' => 'lane',
                'password' => '123456',
                'port' => '3306',
                'db' => DEFAULT_DB,
			),
		),
	),
);