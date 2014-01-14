<?php
/**
 * 公共统计队列.
 * Created by Lane.
 * @Class HttpQueueCommon
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
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