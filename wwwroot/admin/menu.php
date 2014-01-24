<?php
/**
 * 前台菜单分类管理
 * Created by Lane.
 * @Class Menu
 * @Author: lane
 * @Mail: lixuan868686@163.com
 */
class Menu extends AdminController{
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
        $menuList = MenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        $blogMenuList = Func::categoryTree($menuList);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('menu_list');
    }

    /**
     * @descrpition 添加
     */
    public function add(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/menu/add/';
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['pid'] = Request::getRequest('pid', 'str');
            $fields['in_out'] = Request::getRequest('in_out', 'str');
            $fields['seo_title'] = Request::getRequest('seo_title', 'str');
            $fields['seo_description'] = Request::getRequest('seo_description', 'str');
            $fields['seo_keywords'] = Request::getRequest('seo_keywords', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            if(empty($fields['name'])){
                View::showErrorMessage($jumpUrl, '未填写完成');
            }
            $result = MenuBusiness::setMenu($fields);
            if($result){
                View::showMessage('/admin.php/menu/lists', '添加成功');
            }else{
                View::showErrorMessage($jumpUrl, '添加失败');
            }
        }
        $menuList = MenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        $blogMenuList = Func::categoryTree($menuList);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('menu_add');
    }

    /**
     * @descrpition 修改
     */
    public function edit(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/menu/edit/id-'.$this->param['id'];
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['pid'] = Request::getRequest('pid', 'str');
            $fields['in_out'] = Request::getRequest('in_out', 'str');
            $fields['seo_title'] = Request::getRequest('seo_title', 'str');
            $fields['seo_description'] = Request::getRequest('seo_description', 'str');
            $fields['seo_keywords'] = Request::getRequest('seo_keywords', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            if(empty($fields['name'])){
                View::showErrorMessage($jumpUrl, '未填写完成');
            }
            $result = MenuBusiness::editMenu($this->param['id'], $fields);
            if($result){
                View::showMessage('/admin.php/menu/lists', '添加成功');
            }else{
                View::showErrorMessage($jumpUrl, '添加失败');
            }
        }
        $menuList = MenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        $blogMenuList = Func::categoryTree($menuList);
        $blogMenu = MenuBusiness::getMenu($this->param['id']);
        View::assign('blogMenu', $blogMenu);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('menu_edit');
    }

    /**
     * @descrpition 删除
     */
    public function delete(){
        MenuBusiness::delMenu($this->param['id']);
        View::showMessage('/admin.php/menu/lists', "删除分类成功!");
    }
}