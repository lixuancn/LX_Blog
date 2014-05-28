<?php
/**
 * 管理员管理
 * Created by Lane.
 * @Class Admin
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class Admin extends AdminController {

    protected $sessionId = 'admin_user_login';

    protected $adminUserObj;

	public function __construct($param) {
        parent::__construct($param);
		$this->adminUserObj = new AdminUserModel();
	}
	
	/**
	 * @descrpition 管理员分页列表...
	 */
	public function lists() {
		$adminUserList = $this->adminUserObj->getList();
	    View::assign('adminUserList', $adminUserList);
		View::showAdminTpl('admin_list');
	}
	
	/**
	 * @descrpition 添加管理员...
	 */
	public function add() {
        //表单提交处理
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/admin/add';
            $username = Request::getRequest('username', 'str');
            $password = Request::getRequest('password', 'str');
            $password1 = Request::getRequest('password1', 'str');
            //验证提交信息
            if (empty($username) || empty($password) || empty($password1) ) {
                View::showAdminErrorMessage($jumpurl, '缺失参数!');
            }
            if ($password != $password1) {
                View::showAdminErrorMessage($jumpurl, '密码不正确!');
            }
            $fields = array();
            $fields['username'] = $username;
            $fields['password'] = strtolower(md5($username.PASSWORD_INTERFERE.$password));
            $result = $this->adminUserObj->add($fields);
            if ($result === true) {
                View::showAdminMessage($jumpurl, '添加管理员成功!');
            } else {
                View::showAdminErrorMessage($jumpurl, '用户名已经存在');
            }
        }
        //显示表单页
        View::showAdminTpl('admin_add');
	}
	
	/**
	 * @descrpition 编辑管理员 ...
	 */
	public function edit() {
        $id = $this->param['id'];
        $jumpurl = '/admin.php/admin/edit/id-'.$id;
        $adminUser = $this->adminUserObj->get($id);
        if (empty($adminUser)) {
            View::showAdminErrorMessage('/admin.php/admin/lists', '该管理员不存在!');
        }
        //表单提交处理
        if (Request::getRequest('dosubmit', 'str')) {
            $password = Request::getRequest('password', 'str');
            $password1 = Request::getRequest('password1', 'str');
            //验证提交信息
            if (empty($password) || empty($password1) ) {
                View::showAdminErrorMessage($jumpurl, '缺失参数!');
            }
            if ($password != $password1) {
                View::showAdminErrorMessage($jumpurl, '密码不正确!');
            }
            $fields = array();
            $fields['password'] = strtolower(md5($adminUser['username'].PASSWORD_INTERFERE.$password));
            $result = $this->adminUserObj->edit($id, $fields);
            if ($result) {
                View::showAdminMessage($jumpurl, '修改管理员成功!');
            } else {
                View::showAdminErrorMessage($jumpurl, '修改管理员失败!');
            }
        }
        View::assign('adminUser', $adminUser);
		View::showAdminTpl('admin_edit');
	}
	
	/**
	 * @descrpition 删除管理员 ...
	 */
	public function delete() {
        $jumpurl = '/admin.php/admin/lists';
        $id = $this->param['id'];
		if (!$id) {
			View::showAdminErrorMessage($jumpurl, '管理员ID不能为空!');
		}
		if ($this->adminUserObj->del($id)) {
			View::showAdminMessage($jumpurl, "删除管理员成功!");
		} else {
			View::showAdminErrorMessage($jumpurl, "删除管理员失败!");
		}
	}


    /**
     * @descrpition 后台登录 ...
     */
    public function login() {
        $loginInfo = Request::getSession($this->sessionId);
        if (!empty($loginInfo) && !empty($loginInfo['username']) && !empty($loginInfo['id'])) {
            View::showAdminMessage('/admin.php/index/main', '已经登录!');
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
                View::jsJump('/admin.php/index/main');
            } else {
                View::showAdminErrorMessage('/admin.php/admin/login', '登录后台失败!');
            }
        }
        View::showAdminTpl('login');
    }

    /**
     * @descrpition 后台登出 ...
     */
    public function loginout() {
        Response::delSession($this->sessionId);
        View::showAdminMessage('/admin.php/admin/login', "退出后台成功!");
    }
}
?>