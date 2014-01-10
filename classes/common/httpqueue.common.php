<?php
/**
 * 公共统计队列.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2012-9-1
 * @version $Id: httpqueue.common.php 1145 2013-10-24 09:46:29Z manling $
 */

class HttpQueueCommon {
	public static function call($kid, $queueName, $info, $mod='', $action='run') {
		$queue = new CloudTaskQueue($queueName);
		
		$logtime = time();
		$params = base64_encode(json_encode($info));
		$key = Func::madeQueueKey($kid, $logtime, $params);
		$queue->addTask(QUEUE_URL, "mod=$mod&action=$action&kid=$kid&logtime=$logtime&params=".urlencode($params)."&key=$key");
		$ret = $queue->push();

		return true;
	}
	
	/**
	 * 
	 * 添加用户行为日志
	 * @param unknown_type $kid
	 * @param unknown_type $info
	 */
	public static function addUserAction($kid, $info) {
		return self::call($kid, HttpQueueConstant::QUEUE_USER_ACTION, $info, 'useraction','setUserAction');
	}
}
?>