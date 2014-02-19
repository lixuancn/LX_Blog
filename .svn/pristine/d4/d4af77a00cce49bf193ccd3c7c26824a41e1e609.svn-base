<?php
/**
 * Memcached 封装类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-6-28 
 * @version $Id: mcache.lib.php 77 2013-07-01 11:59:17Z manling $
 */

class Mcache {

	public static $mc;

	//初始化成功
	const INIT_SUCCESS = 0;
	
	//初始化失败的错误码
	const ERROR_INIT = -1;
	
	//错误码用于标识是否是初始化失败
	public static $error_code = 0;
	
	private static function init () {
		self::$error_code = self::INIT_SUCCESS;
		
		if (empty(self::$mc)) {
			self::$mc = new CloudMemcache();
			if (self::$mc == false) {
				self::$error_code = self::ERROR_INIT;
				return false;
			}
		}
	}

	public static function set ($key, $value, $time = 7200) {
		if( false===self::init()) return false;
		return self::$mc->memCacheSet($key, $value, $time);
	}

	public static function get ($key) {
		if( false===self::init()) return false;
		return self::$mc->memCacheGet($key);
	}

	public static function delete ($key) {
		if( false===self::init()) return false;
		return self::$mc->memCacheDelete($key);
	}
	
	public static function getErrorCode(){
		return self::$error_code;
	}
}
?>
