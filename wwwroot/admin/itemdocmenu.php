<?php
/**
 * 项目管理 - 前台菜单分类管理
 * Created by Lane.
 * @Class Menu
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class ItemDocMenu extends AdminController{
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
        $menuList = ItemDocMenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        $blogMenuList = Func::categoryTree($menuList);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('item_doc_menu_list');
    }

    /**
     * @descrpition 添加
     */
    public function add(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/itemdocmenu/add/';
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['pid'] = Request::getRequest('pid', 'str');
            $fields['in_out'] = Request::getRequest('in_out', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            $fields['item'] = strtolower(Request::getRequest('item', 'str'));
            if(empty($fields['name']) || empty($fields['item'])){
                View::showAdminErrorMessage($jumpUrl, '未填写完成');
            }
            $result = ItemDocMenuBusiness::setMenu($fields);
            if($result){
                View::showAdminMessage('/admin.php/itemdocmenu/lists', '添加成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '添加失败');
            }
        }
        $menuList = ItemDocMenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        $blogMenuList = Func::categoryTree($menuList);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('item_doc_menu_add');
    }

    /**
     * @descrpition 修改
     */
    public function edit(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/itemdocmenu/edit/id-'.$this->param['id'];
            $fields = array();
            $fields['name'] = Request::getRequest('name', 'str');
            $fields['pid'] = Request::getRequest('pid', 'str');
            $fields['in_out'] = Request::getRequest('in_out', 'str');
            $fields['url'] = Request::getRequest('url', 'str');
            $fields['item'] = strtolower(Request::getRequest('item', 'item'));
            if(empty($fields['name']) || empty($fields['item'])){
                View::showAdminErrorMessage($jumpUrl, '未填写完成');
            }
            $result = ItemDocMenuBusiness::editMenu($this->param['id'], $fields);
            if($result){
                View::showAdminMessage('/admin.php/itemdocmenu/lists', '修改成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '修改失败');
            }
        }
        $menuList = ItemDocMenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        $blogMenuList = Func::categoryTree($menuList);
        $blogMenu = ItemDocMenuBusiness::getMenu($this->param['id']);
        View::assign('blogMenu', $blogMenu);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('item_doc_menu_edit');
    }

    /**
     * @descrpition 删除
     */
    public function delete(){
        ItemDocMenuBusiness::delMenu($this->param['id']);
        View::showAdminMessage('/admin.php/itemdocmenu/lists', "删除分类成功!");
    }
}