<?php
/**
 * 菜单控制器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: menu.php 1 2013-05-30 06:40:35Z manling $
 */

class Menu extends AdminController {
	var $menuObj = null;
	var $navObj = null;
	
	function __construct() {
		$this->menuObj = $this->loadModel('menu');
		$this->navObj = $this->loadModel('nav');
	}
	
	/**
	 * 菜单分页列表...
	 */
	function lists() {
		$order = Request::getRequest('order', 'str', 'menu_id');
		$sort = Request::getRequest('sort', 'str', 'DESC');
		$page = Request::getRequest('page', 'int', 1);
		$pagesize = Request::getRequest('pagesize', 'int', 20);
		$wheres = Request::getRequest('wheres', '', array());

		$info = $this->menuObj->getMenuPageList($wheres, $page, $pagesize, "$order $sort");
		$navs = $this->navObj->getNavList();

		View::assign('info', $info);
		View::assign('navs', $navs);
		View::assign('order', $order);
		View::assign('sort', $sort);
		View::assign('wheres', $wheres);
		View::assign('page', $page);
		View::assign('pagesize', $pagesize);

		View::showAdminTpl('menu_list');
	}
	
	/**
	 * 添加菜单...
	 */
	function add() {
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = '/admin.php/menu/lists';
			$info = Request::getRequest('info', '', array());

			if ($this->menuObj->addMenu($info)) {
				View::showMessage($jumpurl, '添加菜单成功!');
			} else {
				View::showErrorMessage($jumpurl, '添加菜单失败!');
			}
		}
		//显示表单页
		View::assign('navs', $this->navObj->getNavList());
		View::assign('jumpurl', '/admin.php/menu/lists');
		
		View::showAdminTpl('menu_add');
	}
	
	/**
	 * 编辑菜单 ...
	 */
	function edit() {
		$menuId = Request::getRequest('menuid', 'int');
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', 'str');
			$info = Request::getRequest('info', '', array());
			
			if($this->menuObj->editMenu($menuId, $info)) {
				View::showMessage($jumpurl, '编辑菜单成功!');
			} else {
				View::showErrorMessage($jumpurl, '编辑菜单失败!');
			}
		}
		//显示表单页
		$info = $this->menuObj->getMenuOne($menuId);
		View::assign('menuid', $menuId);
		View::assign('info', $info);
		View::assign('navs', $this->navObj->getNavList());
		View::assign('jumpurl', Request::getRefererUrl());
		
		View::showAdminTpl('menu_edit');
	}
	
	/**
	 * 删除菜单 ...
	 */
	function delete() {
		$menuId = Request::getRequest('menuid', 'int');
		$jumpurl = Request::getRefererUrl();
		if (!$menuId) {
			View::showErrorMessage($jumpurl, '菜单ID不能为空!');
		}
		
		if ($this->menuObj->deleteMenu($menuId)) {
			View::showMessage($jumpurl, "删除菜单成功!");
		} else {
			View::showErrorMessage($jumpurl, "删除菜单失败!");
		}
	}
	
	/**
	 * 更新菜单排序...
	 */
	function editorder() {
		$jumpurl = Request::getRefererUrl();
		$orders = Request::getRequest('orders', '');
		
		if ($this->menuObj->editorder($orders)) {
			View::showMessage($jumpurl, "更新排序成功!");
		} else {
			View::showErrorMessage($jumpurl, "更新排序失败!");
		}
	}

	/**
	 * 批量更新菜单 ...
	 */
	function batchedit() {
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', '');
			$infos = Request::getRequest('infos', '');
			if($this->menuObj->batchEditMenu($infos)) {
				View::showMessage($jumpurl, '批量修改导航成功!');
			} else {
				View::showErrorMessage($jumpurl, '批量修改导航失败!');
			}
		}
		//显示表单页
		$infos = array();
		$ids = Request::getRequest('ids', '');
		foreach($ids as $menuId) {
			$infos[] = $this->menuObj->getMenuOne($menuId);
		}
		View::assign('infos', $infos);
		View::assign('parents', $this->menuObj->getMenuList('parent_id=0'));
		View::assign('navs', $this->navObj->getNavList());
		View::assign('jumpurl', Request::getRefererUrl());
		View::showAdminTpl('menu_batch_edit');
	}
	
	
	/**
	 * 批量删除菜单 ...
	 */
	function batchdelete() {
		$jumpurl = Request::getRefererUrl();
		$ids = Request::getRequest('ids', '');
		
		if ($this->menuObj->batchDeleteMenu($ids)) {
			View::showMessage($jumpurl, "批量删除成功!");
		} else {
			View::showErrorMessage($jumpurl, "批量删除失败!");
		}
	}
	
	function getajaxmenu() {
		$navId = Request::getRequest('navid', 'str');
		$selectMenuId = Request::getRequest('selectid', 'str');
		$parentMenus = $this->menuObj->getMenuList("parent_id=0 and nav_id='$navId'");
		
		$optionStr = '<option value="0">=顶级菜单=</option>';
		foreach($parentMenus as $row) { 
			if ($row['menu_id'] == $selectMenuId) {
				$optionStr .= '<option value="'.$row['menu_id'].'" selected="selected">'.$row['menu_name'].'</option>';
			} else {
				$optionStr .= '<option value="'.$row['menu_id'].'">'.$row['menu_name'].'</option>';
			}
		}
		
		exit($optionStr);
	}
}
?>