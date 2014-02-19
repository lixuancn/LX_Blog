<?php
 /**
 * CEE Kvdb操作基础函数
 * 
 * @author: Li Manling <manling@staff.sina.com.cn>
 * @date: 2011-8-19
 * @copyright: sina
 * @version Id
 */
class KvClient {
	protected $redis = null;
	
	private $_errno	= '0';
	private $_errmsg = '';
	private $_keyPrefix = '';
	
	const INIT_KVDB_ERROR = 31;
	const KVDB_CLOSED_ERROR = 34;
	const PARAM_ERROR = 40;
	const INTERACTION_ERROR = 41;
	const KEY_NOT_EXISTS_ERROR = 45;
	
	const MAX_KEY_LENGTH = 200;
	const MAX_PKRGET_SIZE = 100;
	
	public function __construct() {

	}
	
	public function init() {
		$this->redis = new Redis();
		$this->redis->connect(REDIS_HOST, REDIS_PORT);
		$this->redis->auth(REDIS_AUTH);
		$this->redis->select(REDIS_DB);

		$this->_keyPrefix = REDIS_PRE;	
	}
	
	public function set($key, $value) {
		if (!$this->hasInited())return false;
		
		if (empty($key)) {
			$this->_errno = self::PARAM_ERROR;
			$this->_errmsg = "Invalid Parameters" ;
			return false;
		}
		
		$key = $this->getNomalKey($key);
		if (strlen($key) > self::MAX_KEY_LENGTH) {
			$this->_errno = self::PARAM_ERROR;
			$this->_errmsg = "Invalid Parameters" ;
			return false;
		}
		
		//检查是否是数组
		if (is_array($value)) {
			$value = serialize($value);
		}
		
		$rst = $this->redis->set($key, $value);
		if(!$rst) {
			$this->checkError();
			return false;
		}

		return true;
	}

	public function get($key) {
		if(!$this->hasInited())return false;
		
		if (empty($key)) {
			$this->_errno = self::PARAM_ERROR;
			$this->_errmsg = "Invalid Parameters" ;
			return false;
		}

		$key = $this->getNomalKey($key);
		if (strlen($key) > self::MAX_KEY_LENGTH) {
			$this->_errno = self::PARAM_ERROR;
			$this->_errmsg = "Invalid Parameters" ;
			return false;
		}
		
		$val = $this->redis->get($key);
		$val = $this->_parser($val);

		return $val;
	}

	public function delete($key) {
		if(!$this->hasInited())return false;
		
		if (empty($key)) {
			$this->_errno = self::PARAM_ERROR;
			$this->_errmsg = "Invalid Parameters" ;
			return false;
		}
		
		$key = $this->getNomalKey($key);
		if (strlen($key) > self::MAX_KEY_LENGTH) {
			$this->_errno = self::PARAM_ERROR;
			$this->_errmsg = "Invalid Parameters" ;
			return false;
		}
		
		if (!$this->redis->exists($key)) {
			return true;
		}
		
		$rst = $this->redis->delete($key);
		if(!$rst) {
			$this->checkError();
			return false;
		}

		return true;
	}

	/**
	 * 如果从kvdb取到的数据是false时，以下几种情况为正常情况
	 * (1)值本身是false. 正常返回code为0.
	 * (2)key不存在,错误码为41,子错误码为16.平台会新增一个错误码45专门针对未找到key的情况
	 * code:41 
	 * msg:Interaction Error (16) With KV DB Server: NOT FOUND
	 * @param unknown_type $ret
	 */
	public function errorHandle($api='get'){		
		$errno = $this->errno();
		$errmsg = $this->errmsg();
		
		if((self::INTERACTION_ERROR == $errno)) return true;
		if(self::KEY_NOT_EXISTS_ERROR==$errno) return true;
		if(empty($errno)) return true;
		
		error_log("$api weisanguo kvdb op failed.(". $errno . ':' . $errmsg . ")");
		//die("$api weisanguo kvdb op failed.(" . $errno . ':' . $errmsg . ")");
		die("系统繁忙，请稍后刷新重试。(" . $api . $errno . ':' . $errmsg . ")");
	}
	
	/**
	 * 返回错误码
	 *
	 * @return string
	 */
	public function errno() {
		return $this->_errno;
	}
	
	/**
	 * 返回错误信息
	 *
	 */
	public function errmsg() {
		return $this->_errmsg;
	}
	
	/**
	 * 获取KEY的全称 ...
	 * @param unknown_type $uKey
	 * @return string
	 */
	private function getNomalKey($uKey) {
		//error_log($this->_keyPrefix.$uKey);
		return $this->_keyPrefix.$uKey ;
	}
	
	/**
	 * Redis初始化检测 ...
	 * @return boolean
	 */
	private function hasInited() {
		if(!$this->redis) {
			$this->_errno	= self::INIT_KVDB_ERROR;
			$this->_errmsg	= "KVDB Server is uninited";
			return false;
		}

		return true;
	}
	
	/**
	 * 检查接口调用错误 ...
	 * @param unknown_type $last
	 * @return boolean
	 */
	private function checkError($last = true) {
		$this->_errno = '0';
		$this->_errmsg = "OK";

		try {
			$this->redis->ping();
		} catch(Exception $e ) {
			$this->_errno	= self::KVDB_CLOSED_ERROR;
			$this->_errmsg	= "KV DB Server CLOSED";
			return false;
		}

		if($last) {
			$this->_errno	= self::INTERACTION_ERROR;
			$this->_errmsg	= 'Interaction Error With KVDB Server';
		}

		return false;
	}
	
	private function _parser($val) {
		$data = $val;
		$arr = @unserialize($val);
		if(is_array($arr)) {
			$data = $arr;
		}
		
		return $data;
	}
}
?>
