<?php
 /**
 * SAE kvdb操作基础函数
 * 
 * @author: Li Manling <manling@staff.sina.com.cn>
 * @date: 2011-8-19
 * @copyright: sina
 * @version Id
 */
class KvClient {
	
	public $kv;
		
	const SUCCESS_CODE = 0;
	
	const NOT_FOUND_CODE = 41;
	
	const NEW_NOT_FOUND_CODE = 45;
	
	public function __construct () {
		$this->kv = new SaeKVClient();			
	}
	
	public function init() {
		// 初始化KVClient对象
 		$ret = $this->kv->init();
		if ($ret === false) {
			$this->errorHandle('init');
		}	
	}
	
	public function set ($key, $value) {
		$ret = $this->kv->set($key, $value);
		if( false===$ret ){
			$this->errorHandle('set',$key);
		}
		return $ret;
	}
	
	public function get ($key) {
		$ret = $this->kv->get($key);
		if( false===$ret ){
			$this->errorHandle('get',$key);
		}
		return $ret;
	}

	public function delete ($key) {
		$ret = $this->kv->delete($key);
		if( false===$ret ){
			//找不到这个key，删除算是成功的
			return $this->errorHandle('delete',$key);
		}
		return $ret;
	}

	/**
	 * 如果从kvdb取到的数据是false时，以下几种情况为正常情况
	 * (1)值本身是false. 正常返回code为0.
	 * (2)key不存在,错误码为41,子错误码为16.平台会新增一个错误码45专门针对未找到key的情况
	 * code:41 
	 * msg:Interaction Error (16) With KV DB Server: NOT FOUND
	 * @param unknown_type $ret
	 */
	public function errorHandle($api='get', $key=''){		
		$errno = $this->kv->errno();
		$errmsg = $this->kv->errmsg();
		
		//sae_debug("$api weisanguo kvdb op failed.(". $errno . ':' . $errmsg . ")");
		if( (self::NOT_FOUND_CODE == $errno) && ( false!==strpos($errmsg, '(16)') ) ) return true;
		if( self::NEW_NOT_FOUND_CODE==$errno ) return true;
		if( self::SUCCESS_CODE == $errno ) return true;
		
		error_log("$api".'-'."$key kvdb op failed.(". $errno . ':' . $errmsg . ")");
		//die("$api weisanguo kvdb op failed.(" . $errno . ':' . $errmsg . ")");
		die("系统繁忙，请稍后刷新重试。(" . $api .'-'.$key.' '. $errno . ':' . $errmsg . ")");
	}
	
	public function errno(){
		return $this->kv->errno();
	}
	
	public function errmsg(){
		return $this->kv->errmsg();
	}
	
}
?>
