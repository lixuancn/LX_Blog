<?php
/**
 * CEE Memcache模拟.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2012-1-19 
 * @version $Id: memcache.class.php 1804 2013-12-11 10:06:52Z lixuan $
 */

class CloudMemcache {
	
	public function __construct() {
		$this->mckeyPre = MEMCACHE_PRE;
		$this->mc = memcache_connect(MC_HOST, MC_PORT);
	}
	
	
	public function memCacheSet($key, $value, $time) {
		$key = $this->mckeyPre . $key;
		return memcache_set($this->mc, $key, $value, 0, $time);
	}
	
	public function memCacheGet($key) {
		$key = $this->mckeyPre . $key;
		return memcache_get($this->mc, $key);
	}

	public function memCacheDelete($key) {
		$key = $this->mckeyPre . $key;
		return memcache_delete($this->mc, $key);
	}
}
?>