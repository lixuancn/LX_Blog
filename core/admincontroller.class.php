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
     *
     * 构造函数
     * @param $param 实例化时传入的参数
     */
    public function __construct($param=array()){
        $this->param = $param;
        //分类菜单相关
        $adminMenuObi = new AdminMenuModel();
        $this->menuList = $adminMenuObi->getListByPid();
        $this->menuList = Func::arrayKey($this->menuList);
        $actionMenuId = 0;
        if(isset($param['mid']) && isset($this->menuList[$param['mid']])){
            $actionMenuId = $param['mid'];
        }
        View::assign('actionMenuId', $actionMenuId);
        View::assign('menuList', $this->menuList);
    }
}

?>