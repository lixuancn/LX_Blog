<?php
/**
 * 管理员数据模型类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-6-29 
 * @version $Id: admin.class.php 48 2013-09-09 11:27:55Z manling $
 */

class AdminModel extends DBModel {
	
	protected $tableAdmin = 'admin_admin';
	
	function __construct() {
		parent::__construct();
	}
	
	function getAdminOne($uid) {
		if (empty($uid)) return false;
		
		$where = "user_id=" . $uid;
		return $this->selectOne($this->tableAdmin, $where, "*");
	}
	
	function getAdminPageList($wheres, $page=1, $pagesize=20, $order='') {
		$where = $this->compareCondition($wheres);
		return $this->selectPageList($this->tableAdmin, $where, $page, $pagesize, "*", $order);
	}
	
	function getAdminList($where='') {
		return $this->selectList($this->tableAdmin, $where, "*", 'user_id desc');
	}
	
	function login($username, $password, $rememberMe='false') {
		if (empty($username) || empty($password)) return false;
		
		$where = "`username`='$username' and `password`='".md5($password)."'";
		$res = $this->getAdminList($where);
		if (!$res) {
			return false;
		}
		//更新登录IP和时间
		$info = array('last_login_ip' => Request::getClientIP(), 'last_login_time' => time());
		$this->editAdmin($res[0]['user_id'], $info);
		//设置Session
		Response::setCookie('admin_uid', $res[0]['user_id']);
		Response::setCookie('admin_gid', $res[0]['group_id']);
		Response::setCookie('admin_auth', Encryption::symmetric($res[0]['user_id']."\t".md5($password), 'ENCODE'));
		if ($rememberMe) {
			Response::setCookie('rememberme_key',  Encryption::symmetric($username."\t".$password, 'ENCODE'), time()+24*3600*360);
		} else {
			Response::delCookie('rememberme_k6ey');
		}
		
		return true;
	}
	
	function logout() {
		Response::delCookie('admin_uid');
		Response::delCookie('admin_gid');
		Response::delCookie('admin_auth');
		Response::delCookie('rememberme_key');
	}
	
	function isLogined() {
		$uid = Request::getCookie('admin_uid',0);
		$gid = Request::getCookie('admin_gid',0);
		$auth = Request::getCookie('admin_auth','');
		
		if (empty($uid) || empty($gid) || empty($auth)) {
			return false;
		}
		//检查用户登录状态
		$adminInfo = $this->getAdminOne($uid);
		
		if (empty($adminInfo) || $adminInfo['group_id'] != $gid) {
			return false;
		}
		list($_uid, $_password) = explode("\t", Encryption::symmetric($auth, 'DECODE'));
		if ($adminInfo['password'] != $_password) {
			$this->logout(); //注销所有回话信息
			return false;
		}
		return true;
	}
	
	function editPwd($info) {
		if (empty($uid) || empty($password)) return false;
		
		$uid = $uid = Request::getCookie('admin_uid');
		
		$fields = array(
			'password' => md5($password),
		);
		$where = "user_id=$uid";
		
		return $this->update($this->tableAdmin, $fields, $where);
	}
	
	function addAdmin($info=array()) {
		if (empty($info)) return false;
		
		$info['password'] = md5($info['password']);
		$this->insertOne($this->tableAdmin, $info);
		return $this->insertId();
	}
		
	function editAdmin($uid, $info=array()) {
		if (empty($uid) || empty($info)) return false;
		
		$where = "user_id=$uid";
		if (empty($info['password'])) {
			unset($info['password']);
		} else {
			$info['password'] = md5($info['password']);
		}
		
		return $this->update($this->tableAdmin, $info, $where);
	}
	
	function changeDefaultGroup($gid) {
		if (empty($gid)) return false;
		
		$info = array('group_id' => 2);
		$where = "group_id = $gid";
		
		return $this->update($this->tableAdmin, $info, $where);
	}
	
	function deleteAdmin($uid) {
		if (empty($uid)) return false;
		
		$where = "user_id=$uid";
		return $this->deleteOne($this->tableAdmin, $where);
	}
	
	function checkName($name, $id=0) {
	    if(empty($name)) return false;
	    
		$where = "WHERE `username`='$name'";
		if(!empty($id)) $where .= ' AND `user_id`!=' . $id;
		$data = $this->customSelect("SELECT * FROM ".$this->tableAdmin." $where;");
		if($data) {
			return false;
		} else {
			return true;
		}
	}
}

?>