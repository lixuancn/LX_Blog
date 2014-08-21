<?php
/**
 *
 * 项目管理 - 分类菜单
 *
 * Created by Lane.
 * @Class MenuBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-8-20
 * @Time: 下午2:20
 * Blog http://www.lanecn.com
 */
class ItemDocMenuBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return ItemDocMenuDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new ItemDocMenuDbModel();
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

    /**
     * 获取某个项目的菜单
     * @param string $item
     * @return Ambigous|bool
     */
    public static function getMenuListByItem($item=ITEM){
        return self::getInstance()->getListByItem($item);
    }
}