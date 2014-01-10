<?php
/**
 * 菜单管理模型类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-6-29 
 * @version $Id: menu.class.php 1 2013-05-30 06:40:35Z manling $
 */

class MenuModel extends DBModel {
	
	protected $tableMenu = 'admin_menu';
	
	function __construct() {
		parent::__construct();
	}
	
	function getMenuOne($menuId) {
		if (empty($menuId)) return false;
		
		$where = "menu_id=" . $menuId;
		return $this->selectOne($this->tableMenu, $where, "*");
	}
	
	function getMenuByURI($uri) {
		if (empty($uri)) return false;
		
		$where = "url='$uri'";
		return $this->selectOne($this->tableMenu, $where, "*");
	}
	
	function getMenuPageList($wheres, $page=1, $pagesize=20, $order='') {
		$where = $this->compareCondition($wheres);
		return $this->selectPageList($this->tableMenu, $where, $page, $pagesize, "*", $order);
	}
	
	function getMenuList($where='') {
		$where = empty($where) ? "1=1" : $where;
		$order = "menu_id ASC";
		
		$data = array();
		$resData = $this->selectList($this->tableMenu, $where, "*", $order);
		foreach($resData as $row) {
			$data[$row['menu_id']] = $row;
		}
		
		return $data;
	}
	
	function getParentId($where='') {
		$info = $this->selectOne($this->tableMenu, $where, 'parent_id');
		return $info['parent_id'];
	}
	
	function addMenu($info=array()) {
		if (empty($info)) return false;
		
		return $this->insertOne($this->tableMenu, $info);
	}
		
	function editMenu($menuId, $info=array()) {
		if (empty($menuId) || empty($info)) return false;
		
		$where = "menu_id=$menuId";
		return $this->update($this->tableMenu, $info, $where);
	}
	
	function deleteMenu($menuId) {
		if (empty($menuId)) return false;
		
		$where = "menu_id=$menuId";
		return $this->deleteOne($this->tableMenu, $where);
	}
	
	function editOrder($orders) {
		if (empty($orders)) return false;
		
		foreach($orders as $k => $v) {
	        $info = array("sort_order" => intval($v));
	        $this->editMenu($k, $info);
	    }
		
		return true;
	}
	
	function batchEditMenu($infos) {
		if (empty($infos)) return false;
		
		foreach($infos as $menuId => $info) {
			$where = "menu_id=$menuId";
			$this->update($this->tableMenu, $info, $where);
		}
		
		return true;
	}
	
	function batchDeleteMenu($ids) {
		if (empty($ids)) return false;
		
		$where = "menu_id in (".implode(',', $ids).")";
		
		return $this->deleteList($this->tableMenu, $where);
	}
}

?>