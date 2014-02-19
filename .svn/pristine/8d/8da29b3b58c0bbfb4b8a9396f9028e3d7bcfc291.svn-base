<?php
/**
 * Sae TaskQueue模拟器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2012-1-18 
 * @version $Id: taskqueue.class.php 2 2013-06-05 10:21:56Z manling $
 */

class CloudTaskQueue {
	public function __construct($queueName) {
		$this->queueObj = new SaeTaskQueue($queueName);
	}
	
	public function addTask($tasks, $postdata=NULL, $prior=false) {
		return $this->queueObj->addTask($tasks, $postdata, $prior);
	}
	
	public function push() {
		return $this->queueObj->push();
	}
}
?>