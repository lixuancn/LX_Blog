<?php
/**
 * SAE 函数库模拟.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2012-1-19 
 * @version $Id: memcache.class.php 2 2013-06-05 10:21:56Z manling $
 */

class CloudMemcache {
	
	public function __construct() {
		$this->mc = memcache_init();
	}
	
	
	public function memCacheSet($key, $value, $time) {
		return memcache_set($this->mc, $key, $value, 0, $time);
	}
	
	public function memCacheGet($key) {
		return memcache_get($this->mc, $key);
	}
	
	public function memCacheDelete($key) {
		return memcache_delete($this->mc, $key);
	}
}

?>