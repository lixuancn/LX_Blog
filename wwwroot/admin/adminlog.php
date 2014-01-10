<?php
/**
 * 后台日志控制器.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-13 
 * @version $Id: adminlog.php 1 2013-05-30 06:40:35Z manling $
 */

class Adminlog extends AdminController {
	
	function __construct() {
		$this->logObj = new AdminlogModel();
	}
	
	/**
	 * 日志分页列表...
	 */
	function lists() {
		$page = Request::getRequest('page', 'int', 1);
		$pagesize = Request::getRequest('pagesize', 'int', 20);
		$logdate = Request::getRequest('logdate', 'str', date('Y-m-d'));
		$wheres = Request::getRequest('wheres', '', array());
		$wheres['gt_ctime'] = strtotime($logdate);
		$wheres['lt_ctime'] = strtotime($logdate) + 86400;

		$info = $this->logObj->getAdminLogPageList($wheres, $page, $pagesize, "ctime desc");

		View::assign('info', $info);
		View::assign('page', $page);
		View::assign('logdate', $logdate);
		View::assign('pagesize', $pagesize);
		View::assign('wheres', $wheres);
		
		View::showAdminTpl('admin_log_list');
	}

	
	/**
	 * 删除日志 ...
	 */
	function delete() {
		$jumpurl = Request::getRefererUrl();
		$type = Request::getRequest('type', 'str');
		
		if (empty($type)) {
			View::showErrorMessage($jumpurl, "删除日志失败!");
		} elseif ($type == 'week') {
			$logtime = time() - 7*86400;
		} elseif ($type == 'month') {
			$logtime = strtotime(date('Y').(date('m')-1).date('d'));
		}
		
		if ($this->logObj->deleteAdminLog($logtime)) {
			View::showMessage($jumpurl, "删除日志成功!");
		} else {
			View::showErrorMessage($jumpurl, "删除日志失败!");
		}
	}
}
?>