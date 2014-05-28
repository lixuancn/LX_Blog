<?php
/**
 *
 * 分类菜单
 *
 * Created by Lane.
 * @Class MenuBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class MenuBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return MenuDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new MenuDbModel();
        }
        return self::$dbModelObj;
    }

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public static function setMenu($fields){
        return self::getInstance()->add($fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     */
    public static function editMenu($id, $fields){
        return self::getInstance()->edit($id, $fields);
    }

    /**
     * @descrpition 删除数据
     * @param $fields
     */
    public static function delMenu($id){
        return self::getInstance()->del($id);
    }

    /**
     * @descrpition 通过ID获取
     * @param $id
     */
    public static function getMenu($id){
        return self::getInstance()->get($id);
    }

    /**
     * @descrpition 获取列表
     * @param $id
     */
    public static function getMenuList(){
        return self::getInstance()->getList();
    }
}