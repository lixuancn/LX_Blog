<?php
/**
 * 管理员组权限管理模型.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: grouppriv.class.php 1 2013-05-30 06:40:35Z manling $
 */

class GroupprivModel extends DBModel {
	
	protected $tableGrouppriv = 'admin_group_relation_menu';
	
	function __construct() {
		parent::__construct();
		
		$this->init(); //初始化表
	}
	
	function init() {
		$tableDescSql = "CREATE TABLE IF NOT EXISTS `".$this->tableGrouppriv."` (
  `group_id` smallint(6) NOT NULL COMMENT '用户组ID',
  `menu_id` smallint(6) NOT NULL COMMENT '菜单ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组权限表';";
		return $this->customQuery($tableDescSql);
	}
	
	function addGrouppriv($gid, $menus) {
		if (empty($gid) || empty($menus)) return false;
		
		$infos = array();
		foreach ($menus as $menuid) {
			$infos[] = array('group_id' => $gid, 'menu_id' => $menuid);
		}
		
		return $this->insertList($this->tableGrouppriv, $infos);
	}
	
	function deleteGrouppriv($gid) {
		if (empty($gid)) return false;
		
		$where = "group_id=" . $gid;
		return $this->deleteList($this->tableGrouppriv, $where);
	}
	
	function updateGrouppriv($gid, $menus) {
		$this->deleteGrouppriv($gid);
		$this->addGrouppriv($gid, $menus);
	}
	
	function getGrouppriv($gid) {
		if (empty($gid)) return false;
		
		$data = array();
		$where = "group_id=" . $gid;
		$resData = $this->selectList($this->tableGrouppriv, $where, "menu_id");
		foreach($resData as $row) {
			$data[] = $row['menu_id'];
		}
		
		return $data;
	}
}

?>