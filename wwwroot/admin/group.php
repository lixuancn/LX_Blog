<?php
/**
 * 用户组控制器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: group.php 1 2013-05-30 06:40:35Z manling $
 */

class Group extends AdminController {
	function __construct() {
		$this->groupObj = new GroupModel();
		$this->navObj = new NavModel();
		$this->menuObj = new MenuModel();
		$this->privObj = new GroupprivModel();
	}
	
	/**
	 * 用户组分页列表...
	 */
	function lists() {
		$info = $this->groupObj->getGroupList();
		
		View::assign('info', $info);
		View::showAdminTpl('group_list');
	}
	
	/**
	 * 添加用户组...
	 */
	function add() {
		$myUid = Request::getCookie('admin_uid');
		if ($myUid != 1) View::showErrorMessage('/admin.php/group/lists', '对不起，你不是超级管理员!');
		
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = '/admin.php/group/lists';
			$info = Request::getRequest('info', '', array());
			if (empty($info['group_name']) || !$this->groupObj->checkName($info['group_name'])) {
				View::showErrorMessage($jumpurl, '用户组名不能重复！');
			}
			if ($gid=$this->groupObj->addGroup($info)) {
				$menuids = Request::getRequest('menuids', '', array());
				$this->privObj->addGrouppriv($gid,$menuids); //更新权限
				View::showMessage($jumpurl, '添加用户组成功!');
			} else {
				View::showErrorMessage($jumpurl, '添加用户组失败!');
			}
		}
		//显示表单页
		View::assign('navs', $this->navObj->getNavList());
		View::assign('menus', $this->menuObj->getMenuList('parent_id=0'));
		
		View::showAdminTpl('group_add');
	}
	
	/**
	 * 编辑用户组 ...
	 */
	function edit() {
		$myUid = Request::getCookie('admin_uid');
		if ($myUid != 1) View::showErrorMessage(Request::getRefererUrl(), '对不起，你不是超级管理员!');		
		
		$gid = Request::getRequest('gid', 'int', 0);
		
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', 'str');
			$info = Request::getRequest('info', '', array());
			if (empty($info['group_name']) || !$this->groupObj->checkName($info['group_name'], $gid)) {
				View::showErrorMessage($jumpurl, '用户组名不能重复！');
			}
			
			if($this->groupObj->editGroup($gid, $info)) {
				$menuids = Request::getRequest('menuids', '', array());
				$this->privObj->updateGrouppriv($gid,$menuids); //更新权限
				View::showMessage($jumpurl, '编辑用户组成功!');
			} else {
				View::showErrorMessage($jumpurl, '编辑用户组失败!');
			}
		}
		//显示表单页
		$info = $this->groupObj->getGroupOne($gid);
		View::assign('gid', $gid);
		View::assign('info', $info);
		View::assign('jumpurl', Request::getRefererUrl());
		View::assign('navs', $this->navObj->getNavList());
		View::assign('menus', $this->menuObj->getMenuList('parent_id=0'));
		View::assign('privileges', $this->privObj->getGrouppriv($gid));
		View::showAdminTpl('group_edit');
	}
	
	/**
	 * 删除用户组 ...
	 */
	function delete() {
		$myUid = Request::getCookie('admin_uid');
		if ($myUid != 1) View::showErrorMessage(Request::getRefererUrl(), '对不起，你不是超级管理员!');		
		
		$gid = Request::getRequest('gid', 'int');
		$jumpurl = Request::getRefererUrl();
		if (!$gid) {
			View::showErrorMessage($jumpurl, '用户组ID不能为空!');
		}
		
		if ($this->groupObj->deleteGroup($gid)) {
			$this->privObj->deleteGrouppriv($gid);
			//切换到默认组
			$adminObj = new AdminModel();
			$adminObj->changeDefaultGroup($gid);
			View::showMessage($jumpurl, "删除用户组成功!");
		} else {
			View::showErrorMessage($jumpurl, "删除用户组失败!");
		}
	}
	
	function batchedit() {
		$myUid = Request::getCookie('admin_uid');
		if ($myUid != 1) View::showErrorMessage(Request::getRefererUrl(), '对不起，你不是超级管理员!');
		
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', '');
			$infos = Request::getRequest('infos', '');
			if($this->groupObj->batchEditGroup($infos)) {
				View::showMessage($jumpurl, '批量修改用户组成功!');
			} else {
				View::showErrorMessage($jumpurl, '批量修改用户组失败!');
			}
		}
		//显示表单页
		$infos = array();
		$ids = Request::getRequest('ids', '');
		foreach($ids as $gid) {
			$infos[] = $this->groupObj->getGroupOne($gid);
		}
		View::assign('infos', $infos);
		View::assign('jumpurl', Request::getRefererUrl());
		View::showAdminTpl('group_batch_edit');
	}
}
?>