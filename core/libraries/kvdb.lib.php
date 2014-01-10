<?php
 /**
 * kvdb操作基础函数
 * 
 * @author: Li Manling <manling@staff.sina.com.cn>
 * @date: 2011-8-19
 * @copyright: sina
 * @version Id
 */
class Kvdb{
	private static $_kvdb;
	
	public static function connect() {
		if( !is_object(self::$_kvdb) ){
			self::$_kvdb = new KVClient();

			// 初始化KVClient对象
			$ret = self::$_kvdb->init();
			if ($ret === false) {
				exit('初始化对象失败！！');
			}	
		}
		
		
		return self::$_kvdb;
	}
}
?>
