<?php
/**
 * 后台菜单分类管理
 * Created by Lane.
 * @Class AdminMenu
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class AdminMenu extends AdminController{
	/**
	 * @descrpition 构造函数
	 */
	public function __construct($param=array()){
		parent::__construct($param);
	}
	
	/**
	 * @descrpition 列表
	 */
	public function lists(){
        View::assign('menuList', $this->menuListTree);
		View::showAdminTpl('admin_menu_list');
	}

    /**
     * @descrpition 添加
     */
    public function add(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/adminmenu/add/';
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['pid'] = Request::getRequest('pid', 'str');
            $fields['in_out'] = Request::getRequest('in_out', 'str');
            $fields['class'] = Request::getRequest('class', 'str');
            $fields['action'] = Request::getRequest('action', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            if(empty($fields['name'])){
                View::showAdminErrorMessage($jumpUrl, '未填写完成');
            }
            $result = $this->adminMenuObi->add($fields);
            if($result){
                View::showAdminMessage('/admin.php/adminmenu/lists', '添加成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '添加失败');
            }
        }
        View::showAdminTpl('admin_menu_add');
    }

    /**
     * @descrpition 修改
     */
    public function edit(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/adminmenu/edit/id-'.$this->param['id'];
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['pid'] = Request::getRequest('pid', 'str');
            $fields['in_out'] = Request::getRequest('in_out', 'str');
            $fields['class'] = Request::getRequest('class', 'str');
            $fields['action'] = Request::getRequest('action', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            if(empty($fields['name'])){
                View::showAdminErrorMessage($jumpUrl, '未填写完成');
            }

            $result = $this->adminMenuObi->edit($this->param['id'], $fields);
            if($result){
                View::showAdminMessage('/admin.php/adminmenu/lists', '修改成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '修改失败');
            }

        }
        View::assign('editMenu', $this->menuList[$this->param['id']]);
        View::showAdminTpl('admin_menu_edit');
    }

    /**
     * @descrpition 删除
     */
    public function delete(){
        $this->adminMenuObi->del($this->param['id']);
        View::showAdminMessage('/admin.php/adminmenu/lists', "删除分类成功!");
    }
}