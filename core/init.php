<?php
/**
 * 框架初始化文件.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */
//定义页面编码UTF-8
//header('Content-type: text/html; charset=UTF-8');

// 载入系统配置文件
require_once dirname(__FILE__) . '/' . '../config/config.php';

//自动加载扩展库
class SplAutoload
{

	/**
	 * 向PHP注册在自动载入函数
	 */
	public static function register()
	{
		spl_autoload_register(array(new self, 'autoload'));
	}

	/**
	 * 根据类名载入所在文件
	 */
	public static function autoload($className)
	{
		//引入前台扩展类文件
		$filename = LIBRARY_PATH . strtolower($className) . ".lib.php";
		if (file_exists($filename)) {
			require_once $filename;
			return true;
		}

		//引入后台扩展类文件
		$filename = ADMIN_LIBRARY_PATH . strtolower($className) . ".lib.php";
		if (file_exists($filename)) {
			require_once $filename;
			return true;
		}

		//引入apis下的service类
		$filename = APIS_PATH . $className . ".php";
		if (file_exists($filename)) {
			require_once $filename;
			return true;
		}

		//引入Class目录文件
		$lowerClassName = strtolower($className);
		if (preg_match("/(kvmodel|dbmodel|business|common|constant|cache)$/", $lowerClassName, $matches)) {
			$classType = $matches['1'];
			$lowerClassName = str_replace($classType, '', $lowerClassName);
			$filename = CLASSES_PATH . $classType . "/" . $lowerClassName . "." . $classType . ".php";
			if (file_exists($filename)) {
				require_once $filename;
				return true;
			}
		}

		//引入后台Class目录文件
		$className = strtolower($className);
		if (preg_match("/(model)$/i", $className, $matches)) {
			$className = strtolower(str_replace(array(ucfirst($matches[1]), strtolower($matches['1'])), '',$className));
			$filename = ADMIN_CLASSES_PATH . strtolower($matches['1']) . "/" . $className . ".class.php";
			if (file_exists($filename)) {
				require_once $filename;
				return true;
			}
		}

		return false;
	}
}

SplAutoload::register();

//处理全局变量
$GLOBALS['db_config'] = $DATABASE;

// 载入系统核心文件
require_once 'core.php';
?>