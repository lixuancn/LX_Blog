<?php
/**
 * 管理员控制器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: admin.php 48 2013-09-09 11:27:55Z manling $
 */

class Admin extends AdminController {
	
	function __construct() {
		$this->adminObj = new AdminModel();
		$this->groupObj = new GroupModel();
		$this->navObj = new NavModel();
		$this->menuObj = new MenuModel();
	}
	
	/**
	 * 管理员分页列表...
	 */
	function lists() {
		$order = Request::getRequest('order', 'str', 'user_id');
		$sort = Request::getRequest('sort', 'str', 'DESC');
		$page = Request::getRequest('page', 'int', 1);
		$pagesize = Request::getRequest('pagesize', 'int', 20);
		$wheres = Request::getRequest('wheres', '', array());

		$info = $this->adminObj->getAdminPageList($wheres, $page, $pagesize, "$order $sort");
		$groups = $this->groupObj->getGroupList();

		View::assign('info', $info);
		View::assign('groups', $groups);
		View::assign('order', $order);
		View::assign('sort', $sort);
		View::assign('wheres', $wheres);
		View::assign('page', $page);
		View::assign('pagesize', $pagesize);
		View::assign('myuid', Request::getCookie('admin_uid'));
	
		View::showAdminTpl('admin_list');
	}
	
	/**
	 * 添加管理员...
	 */
	function add() {
		$privObj = new AdminprivModel();
		$groupprivObj = new GroupprivModel();
		
		$myUid = Request::getCookie('admin_uid');
		if ($myUid != 1) View::showErrorMessage('/admin.php/admin/lists', '对不起，你不是超级管理员!');
		
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = '/admin.php/admin/lists';
			$info = Request::getRequest('info', '', array());
			$repasswd = Request::getRequest('repasswd', 'str');
			//验证提交信息
			if (empty($info['username']) || empty($info['password']) ) {
				View::showErrorMessage($jumpurl, '缺失参数!');
			}
			if (!$this->adminObj->checkName($info['username'])) {
				View::showErrorMessage($jumpurl, '帐号为 空 或 重复!');
			}
			if ($repasswd != $info['password']) {
				View::showErrorMessage($jumpurl, '验证密码不正确!');
			}
			//添加
			if ($uid=$this->adminObj->addAdmin($info)) {
				$menuids = Request::getRequest('menuids', '', array());
				
				$privObj->addAdminpriv($uid,$menuids); //更新权限
				View::showMessage($jumpurl, '添加管理员成功!');
			} else {
				View::showErrorMessage($jumpurl, '添加管理员失败!');
			}
		}
		//显示表单页
		View::assign('groups', $this->groupObj->getGroupList());
		View::assign('navs', $this->navObj->getNavList());
		View::assign('menus', $this->menuObj->getMenuList('parent_id=0'));
		
		View::showAdminTpl('admin_add');
	}
	
	/**
	 * 编辑管理员 ...
	 */
	function edit() {
		$privObj = new AdminprivModel();
		$groupprivObj = new GroupprivModel();
		
		$myUid = Request::getCookie('admin_uid');
		if ($myUid != 1) View::showErrorMessage(Request::getRefererUrl(), '对不起，你不是超级管理员!');
		
		$uid = Request::getRequest('uid', 'int', 0);
		
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', 'str');
			$info = Request::getRequest('info', '', array());
			$info['is_extends_priv'] = empty($info['is_extends_priv']) ? 0 : 1;
			//验证提交信息
			if (empty($info['username']) || !$this->adminObj->checkName($info['username'], $uid)) {
				View::showErrorMessage($jumpurl, '帐号为 空 或 重复!');
			}
			//更新
			if($this->adminObj->editAdmin($uid, $info)) {
				$menuids = Request::getRequest('menuids', '', array());
				$privObj->updateAdminpriv($uid,$menuids); //更新权限
				View::showMessage($jumpurl, '编辑管理员成功!');
			} else {
				View::showErrorMessage($jumpurl, '编辑管理员失败!');
			}
		}
		//显示表单页
		$info = $this->adminObj->getAdminOne($uid);
		View::assign('uid', $uid);
		View::assign('info', $info);
		View::assign('jumpurl', Request::getRefererUrl());
		View::assign('groups', $this->groupObj->getGroupList());
		View::assign('navs', $this->navObj->getNavList());
		View::assign('menus', $this->menuObj->getMenuList('parent_id=0'));
		View::assign('privileges', $privObj->getAdminpriv($uid));
		View::assign('groupprivs', $groupprivObj->getGrouppriv($info['group_id']));
		View::showAdminTpl('admin_edit');
	}
	
	/**
	 * 删除管理员 ...
	 */
	function delete() {
		$privObj = new AdminprivModel();
		$groupprivObj = new GroupprivModel();
		
		$myUid = Request::getCookie('admin_uid');
		if($myUid != 1) View::showErrorMessage(Request::getRefererUrl(), '对不起，你不是超级管理员!');
		
		$uid = Request::getRequest('uid', 'int');
		$jumpurl = Request::getRefererUrl();
		if (!$uid) {
			View::showErrorMessage($jumpurl, '管理员ID不能为空!');
		}
		
		if ($this->adminObj->deleteAdmin($uid)) {
			$privObj->deleteAdminpriv($uid);
			View::showMessage($jumpurl, "删除管理员成功!");
		} else {
			View::showErrorMessage($jumpurl, "删除管理员失败!");
		}
	}
	
	/**
	 * 后台登录 ...
	 */
	function login() {
		if ($this->adminObj->isLogined()) {
			View::showMessage('/admin.php/frame/index', '已经登录!');
		}
		
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$username = Request::getRequest('username', 'str');
			$password = Request::getRequest('passwd', 'str');
			$rememberMe = Request::getRequest('rememberme', 'str');
			
			if ($this->adminObj->login($username, $password, $rememberMe)) {
				View::showMessage('/admin.php/frame/index', '登录后台成功!');
			} else {
				View::showErrorMessage('/admin.php/admin/login', '登录后台失败!');
			}
		}
		//显示表单页
		$username = '';
		$passwd = '';
		$rememberKey = Request::getCookie('rememberme_key');
		if (!empty($rememberKey)) {
			list($username, $passwd) = explode("\t", Encryption::symmetric($rememberKey, 'DECODE'));
		}
		View::assign('username', $username);
		View::assign('passwd', $passwd);
		View::assign('rememberKey', $rememberKey);
		
		
		View::showAdminTpl('login');
	}
	
	/**
	 * 后台登出 ...
	 */
	function logout() {
		$this->adminObj->logout();
		View::showMessage('/admin.php/admin/login', "退出后台成功!");
	}
	
	function editpwd() {
		$uid = Request::getCookie('admin_uid');
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = "/admin.php/frame/mainframe";
			$passwd = Request::getRequest('password', 'str');
			$repasswd = Request::getRequest('repasswd', 'str');
			$info = Request::getRequest('info', '', array());
			if ($repasswd != $passwd) {
				View::showErrorMessage(Request::getRefererUrl(), '验证密码不正确!');
			}
			//更新
			if($this->adminObj->editAdmin($uid, array('password' => $passwd))) {
				View::showMessage($jumpurl, '修改密码成功!');
			} else {
				View::showErrorMessage($jumpurl, '修改密码失败!');
			}
		}
		//显示表单页
		$info = $this->adminObj->getAdminOne($uid);
		View::assign('info', $info);
		View::showAdminTpl('admin_editpwd');
	}
}
?>