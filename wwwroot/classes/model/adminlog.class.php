<?php
/**
 * 后台日志模型.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: adminlog.class.php 1 2013-05-30 06:40:35Z manling $
 */

class AdminlogModel extends DBModel {
	
	protected $tableAdminLog = 'admin_log';
	
	function __construct() {
		parent::__construct();
	}
	
	function getAdminLogPageList($wheres, $page=1, $pagesize=20, $order='') {
		$where = $this->compareCondition($wheres);
		return $this->selectPageList($this->tableAdminLog, $where, $page, $pagesize, "*", $order);
	}
	
	function addAdminLog($info=array()) {
		if (empty($info)) return false;
		
		$info['ctime'] = time();
		$this->insertOne($this->tableAdminLog, $info);
		return $this->insertId();
	}
	
	function deleteAdminLog($logtime) {
		if (empty($logtime)) return false;
		
		$where = "ctime<$logtime";
		return $this->deleteList($this->tableAdminLog, $where);
	}
}
?>