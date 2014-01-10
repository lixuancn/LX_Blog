<?php
/**
 * 管理员权限模型.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: adminpriv.class.php 1 2013-05-30 06:40:35Z manling $
 */

class AdminprivModel extends DBModel {
	
	protected $tableAdminpriv = 'admin_relation_menu';
	
	function __construct() {
		parent::__construct();
		
		$this->init(); //初始化表
	}
	
	function init() {
		$tableDescSql = "CREATE TABLE IF NOT EXISTS `".$this->tableAdminpriv."` (
  `user_id` bigint(20) NOT NULL COMMENT '用户ID',
  `menu_id` smallint(6) NOT NULL COMMENT '菜单ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员权限表';";
		return $this->customQuery($tableDescSql);
	}
	
	function addAdminpriv($uid, $menus) {
		if (empty($uid) || empty($menus)) return false;
		
		$infos = array();
		foreach ($menus as $menuid) {
			$infos[] = array('user_id' => $uid, 'menu_id' => $menuid);
		}
		
		return $this->insertList($this->tableAdminpriv, $infos);
	}
	
	function deleteAdminpriv($uid) {
		if (empty($uid)) return false;
		
		$where = "user_id=" . $uid;
		return $this->deleteList($this->tableAdminpriv, $where);
	}
	
	function updateAdminpriv($uid, $menus) {
		$this->deleteAdminpriv($uid);
		$this->addAdminpriv($uid, $menus);
	}
	
	function getAdminpriv($uid) {
		if (empty($uid)) return false;
		
		$data = array();
		$where = "user_id=" . $uid;
		$resData = $this->selectList($this->tableAdminpriv, $where, "menu_id");
		foreach($resData as $row) {
			$data[] = $row['menu_id'];
		}
		
		return $data;
	}
}

?>