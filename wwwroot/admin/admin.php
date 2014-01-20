<?php
/**
 * 管理员管理
 * Created by Lane.
 * @Class Admin
 * @Author: lane
 * @Mail: lixuan868686@163.com
 */
class Admin extends AdminController {

    protected $sessionId = 'admin_user_login';

	public function __construct() {
		$this->adminUserObj = new AdminUserModel();
	}
	
	/**
	 * 管理员分页列表...
	 */
	public function lists() {
		$adminUserList = $this->adminUserObj->getList();
	    View::assign('adminUserList', $adminUserList);
		View::showAdminTpl('admin_list');
	}
	
	/**
	 * 添加管理员...
	 */
	public function add() {
        //表单提交处理
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/admin/lists';
            $username = Request::getRequest('username', 'str');
            $password = Request::getRequest('password', 'str');
            $password1 = Request::getRequest('password1', 'str');
            //验证提交信息
            if (empty($username) || empty($password) || empty($password1) ) {
                View::showErrorMessage($jumpurl, '缺失参数!');
            }
            if ($password != $password1) {
                View::showErrorMessage($jumpurl, '密码不正确!');
            }
            $fields = array();
            $fields['username'] = $username;
            $fields['password'] = md5($username.PASSWORD_INTERFERE.$password);
            $result = $this->adminUserObj->add($fields);
            if ($result === true) {
                View::showMessage($jumpurl, '添加管理员成功!');
            } else {
                View::showErrorMessage($jumpurl, '添加管理员失败!');
            }
        }
        //显示表单页
        View::showAdminTpl('admin_add');
	}
	
	/**
	 * 编辑管理员 ...
	 */
	public function edit() {
        $jumpurl = '/admin.php/admin/lists';
        $id = Request::getRequest('id', 'str');
        $adminUser = $this->adminUserObj->get($id);
        if (empty($adminUser)) {
            View::showErrorMessage($jumpurl, '该管理员不存在!');
        }
        //表单提交处理
        if (Request::getRequest('dosubmit', 'str')) {
            $password = Request::getRequest('password', 'str');
            $password1 = Request::getRequest('password1', 'str');
            //验证提交信息
            if (empty($password) || empty($password1) ) {
                View::showErrorMessage($jumpurl, '缺失参数!');
            }
            if ($password != $password1) {
                View::showErrorMessage($jumpurl, '密码不正确!');
            }
            $fields = array();
            $fields['password'] = md5($adminUser['username'].PASSWORD_INTERFERE.$password);
            $result = $this->adminUserObj->add($fields);
            if ($result) {
                View::showMessage($jumpurl, '修改管理员成功!');
            } else {
                View::showErrorMessage($jumpurl, '修改管理员失败!');
            }
        }
		View::showAdminTpl('admin_edit');
	}
	
	/**
	 * 删除管理员 ...
	 */
	public function delete() {
        $jumpurl = '/admin.php/admin/lists';
        $id = Request::getRequest('id', 'str');
		if (!$id) {
			View::showErrorMessage($jumpurl, '管理员ID不能为空!');
		}
		
		if ($this->adminUserObj->del($id)) {
			View::showMessage($jumpurl, "删除管理员成功!");
		} else {
			View::showErrorMessage($jumpurl, "删除管理员失败!");
		}
	}


    /**
     * 后台登录 ...
     */
    public function login() {
        $loginInfo = Request::getSession($this->sessionId);
        if (!empty($loginInfo) && !empty($loginInfo['username']) && !empty($loginInfo['id'])) {
            View::showMessage('/admin.php/admin/list', '已经登录!');
        }

        //表单提交处理
        if (Request::getRequest('dosubmit', 'str')) {
            $username = Request::getRequest('username', 'str');
            $password = Request::getRequest('password', 'str');
            $password = md5($username.PASSWORD_INTERFERE.$password);
            $result = $this->adminUserObj->getByUsername($username);
            if (isset($result) && $result['password'] == $password) {
                $session = array();
                $session['id'] = $result['id'];
                $session['username'] = $result['username'];
                Response::setSession($this->sessionId, $session);
                View::showMessage('/admin.php/frame/index', '登录后台成功!');
            } else {
                View::showErrorMessage('/admin.php/admin/login', '登录后台失败!');
            }
        }
        View::showAdminTpl('login');
    }

    /**
     * 后台登出 ...
     */
    public function logout() {
        Response::delSession($this->sessionId);
        View::showMessage('/admin.php/admin/login', "退出后台成功!");
    }
}
?>