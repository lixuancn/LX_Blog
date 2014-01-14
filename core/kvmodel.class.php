<?php
/**
 * KVDB基础类.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */
 
class KvModel{
	/**
	 * key 前缀
	 * @var string
	 */
	protected $keyPrefix = '';
	
	/**
	 * key 后缀
	 * @var string
	 */
	protected $keySuffix = '';
	
	/**
	 * 唯一标识key
	 * @var string
	 */
	protected $key;
	
	/**
	 * KVDB 操作对象
	 * @var string
	 */
	protected $kvdbObj;
	
	/**
	 * KVDB记录的顶级字段列表
	 * @var array
	 */
	protected $fields = array();
	
	public function __construct(){
		$this->kvdbObj = Kvdb::connect();
	}
	
	/**
	 * 检查字段合法性
	 * @param array $data 数据
	 * @return boolean
	 */
	public function checkFields(&$data) {
		if (!is_array($data)) return true;
		
		if (!empty($this->fields)) {
			foreach ($data as $field => $value) {
				if (!isset($this->fields[$field])) {
					unset($data[$field]);
				}
			}
		}
		
		return true;
	}
	
	/**
	 * 组装KEY
	 * @param string $key 键 : 服_前缀_{kid}_后缀
	 * @return Ambiguous
	 */
	public function getKey($key){		
		return $this->keyPrefix . $key . $this->keySuffix;
	}
	
	/**
	 * 根据完整key查询
	 * @param string $completeKey
	 */
	public function getData($completeKey){
		return $this->kvdbObj->get($completeKey);
	}
	
	/**
	 * 设置KEY值
	 * @param string $key 键
	 * @param array $data 值
	 * @return boolean
	 */
	public function set($key, $data){
		if (empty($key) || is_array($key) || !$this->checkFields($data)) {
			return false;
		}
		if (strlen(json_encode($data)) > 1024*1024) {
			throw new Exception('value is up limit 1M!!', 1000001);
		}
		
		foreach($this->fields as $field => $default) {
			if (!isset($data[$field])) {
				$data[$field] = $default;
			}
		}
		
		return $this->kvdbObj->set($this->getKey($key), $data);
	}
	
	/**
	 * 获取KEY值
	 * @param string $key 键
	 * @return boolean|unknown
	 */
	public function get($key){
		if (empty($key)) return false;
		
		$ret = $this->kvdbObj->get($this->getKey($key));
		if (empty($ret)) {
			return $ret;
		}
		foreach($this->fields as $field => $default) {
			if (!isset($ret[$field])) {
				$ret[$field] = $default;
			}
		}
		
		return $ret;
	}
	
	/**
	 * 获取二维数值中的一行
	 * @param string $key 主键
	 * @param string $subKey 二级键
	 * @param array $default 默认值
	 * @return boolean|Ambigous <unknown, boolean, unknown>
	 */
	public function getOne($key, $subKey, $default=array()) {
		if(empty($key) || empty($subKey)) return false;
		
		$kvData = $this->get($key);
		
		$ret = empty($kvData[$subKey]) ? $default : $kvData[$subKey];
		
		return $ret;
	}
	
	/**
	 * 替换KEY值
	 * @param string $key 键
	 * @param string $data 值
	 * @return boolean
	 */
	public function replace($key, $data) {
		if (empty($key) || empty($data)) return false;
		
		if (strlen(json_encode($data)) > 1024*1024) {
			throw new Exception('value is up limit 1M!!', 1000001);
		}
		
		$kvData = $this->get($key);
		foreach ($data as $k => $v) {
			$kvData[$k] = $v;
		}
		
		return $this->set($key, $kvData); 
	}
	
	/**
	 * 删除KEY值
	 * @param unknown_type $key 键
	 * @return boolean
	 */
	public function delete($key) {
		if (empty($key)) return false;
		
		return $this->kvdbObj->delete($this->getKey($key));
	}
	
	/**
	 * 删除二维数组中一行
	 * @param string $key 主键
	 * @param string $subKey 二级键
	 * @return boolean
	 */
	public function deleteOne($key, $subKey) {
		if(empty($key) || empty($subKey)) return false;
		
		$kvData = $this->get($key);
		unset($kvData[$subKey]);
		
		return $this->set($key, $kvData); 
	}
	
	/**
	 * 初始化KEY值
	 * @param string $key 键
	 * @param unknown_type $data 值
	 * @return boolean
	 */
	public function init($key, $data=array()) {
		if (empty($key) || empty($data) || !$this->checkFields($data)) return false;
		
		if (strlen(json_encode($data)) > 1024*1024) {
			throw new Exception('value is up limit 1M!!', 1000001);
		}
		
		foreach($this->fields as $field => $default) {
			if (!isset($data[$field])) {
				$data[$field] = $default;
			}
		}
		
		return $this->kvdbObj->set($this->getKey($key), $data);
	}
	
	/**
	 * 清除KEY
	 * @param string $key 键
	 * @return boolean
	 */
	public function clear($key) {
		return $this->delete($key);
	}
}
 
 ?>