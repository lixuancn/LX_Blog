<?php
/**
 * 导航控制器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-3 
 * @version $Id: nav.php 1 2013-05-30 06:40:35Z manling $
 */

class Nav extends AdminController {
	var $navObj = null;
	
	function __construct() {
		$this->navObj = $this->loadModel('nav');
	}
	
	/**
	 * 导航分页列表...
	 */
	function lists() {
		$info = $this->navObj->getNavList();
		
		View::assign('info', $info);
		View::showAdminTpl('nav_list');
	}
	
	/**
	 * 添加导航...
	 */
	function add() {
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = '/admin.php/nav/lists';
			$info = Request::getRequest('info', '', array());
			if ($this->navObj->addNav($info)) {
				View::showMessage($jumpurl, '添加导航成功!');
			} else {
				View::showErrorMessage($jumpurl, '添加导航失败!');
			}
		}
		//显示表单页
		View::showAdminTpl('nav_add');
	}
	
	/**
	 * 编辑导航 ...
	 */
	function edit() {
		$navId = Request::getRequest('navid', 'int');
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', 'str');
			$info = Request::getRequest('info', '', array());
			if($this->navObj->editNav($navId, $info)) {
				View::showMessage($jumpurl, '编辑导航成功!');
			} else {
				View::showErrorMessage($jumpurl, '编辑导航失败!');
			}
		}
		//显示表单页
		$info = $this->navObj->getNavOne($navId);
		View::assign('navid', $navId);
		View::assign('info', $info);
		View::assign('jumpurl', Request::getRefererUrl());
		View::showAdminTpl('nav_edit');
	}
	
	/**
	 * 删除导航 ...
	 */
	function delete() {
		$navId = Request::getRequest('navid', 'int');
		$jumpurl = Request::getRefererUrl();
		if (!$navId) {
			View::showErrorMessage($jumpurl, '导航ID不能为空!');
		}
		
		if ($this->navObj->deleteNav($navId)) {
			View::showMessage($jumpurl, "删除导航成功!");
		} else {
			View::showErrorMessage($jumpurl, "删除导航失败!");
		}
	}
	
	/**
	 * 更新导航排序...
	 */
	function editorder() {
		$jumpurl = Request::getRefererUrl();
		$orders = Request::getRequest('orders', '');
		
		if ($this->navObj->editorder($orders)) {
			View::showMessage($jumpurl, "更新排序成功!");
		} else {
			View::showErrorMessage($jumpurl, "更新排序失败!");
		}
	}
	
	function batchedit() {
		//表单提交处理
		if (Request::getRequest('dosubmit', 'str')) {
			$jumpurl = Request::getRequest('jumpurl', '');
			$infos = Request::getRequest('infos', '');
			if($this->navObj->batchEditNav($infos)) {
				View::showMessage($jumpurl, '批量修改导航成功!');
			} else {
				View::showErrorMessage($jumpurl, '批量修改导航失败!');
			}
		}
		//显示表单页
		$infos = array();
		$ids = Request::getRequest('ids', '');
		foreach($ids as $navId) {
			$infos[] = $this->navObj->getNavOne($navId);
		}
		View::assign('infos', $infos);
		View::assign('jumpurl', Request::getRefererUrl());
		View::showAdminTpl('nav_batch_edit');
	}
}
?>