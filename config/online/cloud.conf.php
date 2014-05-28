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
define('DEFAULT_DB', SAE_MYSQL_DB);

//主从类数据库配置信息
$DATABASE = array(
	DEFAULT_DB => array(
		'master' => array(
            'host' => SAE_MYSQL_HOST_M,
            'user' => SAE_MYSQL_USER,
            'password' => SAE_MYSQL_PASS,
            'port' => SAE_MYSQL_PORT,
			'db' => DEFAULT_DB,
		),
		'slave' => array(
			array(
                'host' => SAE_MYSQL_HOST_S,
                'user' => SAE_MYSQL_USER,
                'password' => SAE_MYSQL_PASS,
                'port' => SAE_MYSQL_PORT,
				'db' => DEFAULT_DB,
			),
		),
	),
);