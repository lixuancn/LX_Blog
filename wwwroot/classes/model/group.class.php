<?php
/**
 * 用户组模型.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: group.class.php 1 2013-05-30 06:40:35Z manling $
 */

class GroupModel extends DBModel {
	
	protected $tableGroup = 'admin_group';
	
	function __construct() {
		parent::__construct();
	}
	
	function getGroupOne($gid, $wheres=array()) {
		if (empty($gid)) return false;
		
		$where = "group_id=" . $gid;
		return $this->selectOne($this->tableGroup, $where, "*");
	}
	
	function getGroupList($where='') {
		$where = empty($where) ? "1=1" : $where;
		$order = "group_id DESC";
		
		$data = array();
		$resData =  $this->selectList($this->tableGroup, $where, "*", $order);
		foreach($resData as $row) {
			$data[$row['group_id']] = $row;
		}
		
		return $data;
	}
	
	function addGroup($info=array()) {
		if (empty($info)) return false;
		
		$this->insertOne($this->tableGroup, $info);
		return $this->insertId();
	}
	
	function editGroup($gid, $info=array()) {
		if (empty($gid) || empty($info)) return false;
		
		$where = "group_id=$gid";
		return $this->update($this->tableGroup, $info, $where);
	}
	
	function deleteGroup($gid) {
		if (empty($gid)) return false;
		
		$where = "group_id=$gid";
		return $this->deleteOne($this->tableGroup, $where);
	}
	
	function editOrder($orders) {
		if (empty($orders)) return false;
		
		foreach($orders as $k => $v) {
	        $info = array("sort_order" => intval($v));
	        $this->editGroup($k, $info);
	    }
		
		return true;
	}
	
	function batchEditGroup($infos) {
		if (empty($infos)) return false;
		
		foreach($infos as $gid => $info) {
			$where = "group_id=$gid";
			$this->update($this->tableGroup, $info, $where);
		}
		
		return true;
	}

	function checkName($name, $id=0) {
	    if(empty($name)) return false;
	    
		$where = "WHERE `group_name`='$name'";
		if(!empty($id)) $where .= ' AND `group_id`!=' . $id;
		$data = $this->customSelect("SELECT * FROM ".$this->tableGroup." $where;");
		if($data) {
			return false;
		} else {
			return true;
		}
	}
}
?>