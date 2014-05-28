<?php
/**
 *
 * 分类菜单
 *
 * Created by Lane.
 * @Class TagBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-2-19
 * @Time: 下午3:22
 * Blog http://www.lanecn.com
 */
class TagBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return TagDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new TagDbModel();
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

    /**
     * @descrpition 删除数据
     * @param $fields
     */
    public static function delTag($id){
        return self::getInstance()->del($id);
    }

    /**
     * @descrpition 通过ID获取
     * @param $id
     */
    public static function getTag($id){
        return self::getInstance()->get($id);
    }

    public static function getTagByTag($tag){
        return self::getInstance()->getByTag($tag);
    }

    /**
     * @descrpition 获取列表
     * @param $id
     */
    public static function getTagList(){
        return self::getInstance()->getList();
    }

    /**
     * @descrpition 随机获取Tag列表
     */
    public static function getRandList($limit){
        return self::getInstance()->getRandList($limit);
    }
}