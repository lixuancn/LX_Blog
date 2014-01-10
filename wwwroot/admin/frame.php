<?php
/**
 * 后台框架控制器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: frame.php 55 2013-11-11 07:09:11Z manling $
 */

class Frame extends AdminController {
	
	/**
	 * 框架页 ...
	 */
	function index() {
		View::showAdminTpl('index');
	}
	
	/**
	 * 顶部导航 ...
	 */
	function topframe() {
		$uid = Request::getCookie('admin_uid',0);
		$gid = Request::getCookie('admin_gid',0);
		
		$navObj = new NavModel();
		$menuObj = new MenuModel();
		
		$navs = $navObj->getNavList();
		$topMenus = $menuObj->getMenuList('parent_id=0');

		if ($gid != 1) {
			$navAuths = array();
			$auths = Func::getUserAuths();
			foreach($topMenus as $menuId => $row) {
				if (in_array($menuId, $auths)) {
					$navAuths[$row['nav_id']] = $navs[$row['nav_id']];
				}
			}
		} else {
			$navAuths = $navs;
		}
		
		$adminObj = new AdminModel();
		$adminInfo = $adminObj->getAdminOne($uid);
		$username = empty($adminInfo['username']) ? '匿名用户' : $adminInfo['username'];
		
		$tidQuery = empty($adminInfo['bind_tid']) ? '' : '?tid='.$adminInfo['bind_tid'];

		View::assign('username', $username);
		View::assign('navs', $navAuths);
		View::assign('defaultNavId',2);
		
		View::showAdminTpl('topframe');
	}
	
	/**
	 * 左侧菜单 ...
	 */
	function menuframe() {
		$menuObj = $this->loadModel('menu');
		
		$navId = Request::getRequest('navid', 'int', 2);
		$menus = $menuObj->getMenuList('nav_id='.$navId);
		$parents = $menuObj->getMenuList('nav_id='.$navId . ' and parent_id=0');

		View::assign('gid', Request::getCookie('admin_gid',0));
		View::assign('menus', $menus);
		View::assign('parents', $parents);
		View::assign('auths', Func::getUserAuths());
		View::showAdminTpl('menuframe');
	}
	
	/**
	 * 欢迎首页 ...
	 */
	function mainframe() {
		$groupObj = new GroupModel();
		$gid = Request::getCookie('admin_gid',0);
		$groupInfo = $groupObj->getGroupOne($gid);
		$adminObj = new AdminModel();
		$uid = Request::getCookie('admin_uid',0);
		$adminInfo = $adminObj->getAdminOne($uid);
		
		View::assign('groupname', $groupInfo['group_name']);
		View::assign('username', $adminInfo['username']);
		View::assign('loginip', Request::getClientIP());
		View::assign('lasttime', date('Y-m-d H:i:s', $adminInfo['last_login_time']));
		View::showAdminTpl('mainframe');
	}
}
?>