<?php
/**
 * CEE TaskQueue模拟器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2012-1-18 
 * @version $Id: taskqueue.class.php 1123 2013-10-22 10:43:14Z manling $
 */

class CloudTaskQueue {
	const AUTH_ERROR = 1; //认证失败
	const PARAM_ERROR = 3; //参数错误
	const QUEUE_NOT_EXISTS_ERROR = 10; //队列不存在
	const QUEUE_FULL_ERROR = 11; // 队列已满或剩余长度不足
	const SERVER_ERROR = 500; // 服务内部错误
	const UNKNOWN_ERROR = 999; //未知错误
	const PRI_ERROR = 403; //权限不足或超出配额
	
    private $_accesskey = "";
    private $_secretkey = "";
    private $_errno=0;
    private $_errmsg="OK";
    private $_queues = array();
    
	public function __construct($queueName) {
		$this->redis = new Redis();
		$this->redis->connect(REDIS_HOST, REDIS_PORT);
		$this->redis->auth(REDIS_AUTH);
		$this->redis->select(QUEUE_REDIS_DB);
		$this->_queueName = QUEUE_PRE . $queueName;
	}
	
	public function addTask($tasks, $postdata=NULL, $prior=false, $options=array()) {
		if (!empty($tasks) && is_string($tasks)) {
			if (!filter_var($tasks, FILTER_VALIDATE_URL)) {
				$this->_errno = self::PARAM_ERROR;
				$this->_errmsg = "Unavailable tasks";
				return false;
			}

			//添加单条任务
			$item = array();
			$item['url'] = $tasks;
			$item['postdata'] = ($postdata == NULL) ? NULL : $postdata;
			$item['prior'] = empty($prior) ? false : true;
			$item['options'] = empty($options) ? array() : $options;
			$this->_queues[] = $item;
		} elseif(!empty($tasks) && is_array($tasks)) {
			//添加多条任务
			foreach($tasks as $k => $v) {
				if (is_array($v) && isset($v['url'])) {
					$item = array();
					$item['url'] = $v['url'];
					$item['postdata'] = ($v['postdata'] == NULL) ? NULL : $v['postdata'];
					$item['prior'] = empty($v['prior']) ? false : true;
					$item['options'] = empty($v['options']) ? array() : $v['options'];
					$this->_queues[] = $item;
				} else {
					$this->_errno = self::PARAM_ERROR;
					$this->_errmsg = "Unavailable tasks";
					return false;
				}
			}
		} else {
			return false;
		}

		return true;
	}
	
	public function curLength() {
		return $this->redis->lSize($this->_queueName);
	}
	
	public function leftLength () {
		return 1;
	}
	
	public function push() {
		if (empty($this->_queues)) {
			return false;
		}

		foreach($this->_queues as $key=>$queue) {
			$url = empty($queue['postdata']) ? $queue['url'] : $queue['url'] . '?' . $queue['postdata'];
			if (empty($queue['prior'])) {
				$this->redis->rpush($this->_queueName, $url);
				unset($this->_queues[$key]);
			} else {
				$this->redis->lpush($this->_queueName, $url);
				unset($this->_queues[$key]);
			}
		}
		
		return true;
	}
	
	public function setAuth($accesskey, $secretkey) {
		
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
}
?>