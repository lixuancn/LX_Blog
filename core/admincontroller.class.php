<?php
/**
 * 管理后台控制器
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */

class AdminController {
    /**
     * 本类接收到的实例化时的参数
     * @var $param
     */
    protected $param;

    /**
     * 分类菜单列表
     * @var $menuList
     */
    protected $menuList;

    /**
     * 分类菜单列表 - 树形
     * @var array
     */
    protected $menuListTree;

    /**
     * @var 分类MODEL层对象
     */
    protected $adminMenuObj;

    /**
     *
     * 构造函数
     * @param $param 实例化时传入的参数
     */
    public function __construct($param=array()){
        $this->param = $param;
        //分类菜单相关
        $this->adminMenuObi = new AdminMenuModel();
        $this->menuList = $this->adminMenuObi->getList();
        $this->menuList = Func::arrayKey($this->menuList);
        $this->menuListTree = Func::categoryTree($this->menuList);
        View::assign('menuList', $this->menuListTree);
    }
}

?>