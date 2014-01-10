<?php
/**
 * 导航管理模型.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: nav.class.php 1 2013-05-30 06:40:35Z manling $
 */

class NavModel extends DBModel {
	
	protected $tableNav = 'admin_navigate';
	
	function __construct() {
		parent::__construct();
	}
	
	function getNavOne($navId) {
		if (empty($navId)) return false;
		
		$where = "nav_id=" . $navId;
		return $this->selectOne($this->tableNav, $where, "*");
	}
	
	function getNavList($where="") {
		$where = empty($where) ? "1=1" : $where;
		$order = "sort_order ASC";
		
		$data = array();
		$resData =  $this->selectList($this->tableNav, $where, "*", $order);
		foreach($resData as $row) {
			$data[$row['nav_id']] = $row;
		}
		
		return $data;
	}
	
	function addNav($info=array()) {
		if (empty($info)) return false;
		
		return $this->insertOne($this->tableNav, $info);
	}
	
	function editNav($navId, $info=array()) {
		if (empty($navId) || empty($info)) return false;
		
		$where = "nav_id=$navId";
		return $this->update($this->tableNav, $info, $where);
	}
	
	function deleteNav($navId) {
		if (empty($navId)) return false;
		
		$where = "nav_id=$navId";
		return $this->deleteOne($this->tableNav, $where);
	}
	
	function editOrder($orders) {
		if (empty($orders)) return false;
		
		foreach($orders as $k => $v) {
	        $info = array("sort_order" => intval($v));
	        $this->editNav($k, $info);
	    }
		
		return true;
	}
	
	function batchEditNav($infos) {
		if (empty($infos)) return false;
		
		foreach($infos as $navId => $info) {
			$where = "nav_id=$navId";
			$this->update($this->tableNav, $info, $where);
		}
		
		return true;
	}
}
?>