<?php
/**
 * 数据库工厂类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-6-21 
 * @version $Id: db.lib.php 1652 2013-12-03 11:57:27Z manling $
 */

class DB {
	public static $dbObj = array();
	
	public static function getCon($dsn) {
		if (empty($dsn)) return false;
		
		$dbType = 'mysqlrw';		
		$app = $dsn['master']['db'];
		if( isset(self::$dbObj[$app][$dbType]) && is_object(self::$dbObj[$app][$dbType]) ){			
			return self::$dbObj[$app][$dbType];
		}
				
		require_once SYSTEM_PATH . 'database/'.$dbType.'.class.php';
		
		$dbObj = new Mysqlrw($dsn);
		self::$dbObj[$app][$dbType] = $dbObj;
		
		return $dbObj;
	}
}
?>