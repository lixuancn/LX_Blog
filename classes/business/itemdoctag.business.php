<?php
/**
 *
 * 项目手册 - Tag
 *
 * Created by Lane.
 * @Class TagBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-8-20
 * @Time: 上午11:54
 * Blog http://www.lanecn.com
 */
class ItemDocTagBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return TagDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new ItemDocTagDbModel();
        }
        return self::$dbModelObj;
    }

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public static function setTag($fields){
        return self::getInstance()->add($fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     */
    public static function editTag($id, $fields){
        return self::getInstance()->edit($id, $fields);
    }

    public static function getTagByTag($tag){
        return self::getInstance()->getByTag($tag);
    }
}