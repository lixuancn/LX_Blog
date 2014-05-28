<?php
/**
 *
 * 友情链接
 * 
 * Created by Lane.
 * @Class FriendLinkBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class FriendLinkBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return FriendLinkDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new FriendLinkDbModel();
        }
        return self::$dbModelObj;
    }

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public static function setFriendLink($fields){
        return self::getInstance()->add($fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     */
    public static function editFriendLink($id, $fields){
        return self::getInstance()->edit($id, $fields);
    }

    /**
     * @descrpition 删除数据
     * @param $fields
     */
    public static function delFriendLink($id){
        return self::getInstance()->del($id);
    }

    /**
     * @descrpition 通过ID获取
     * @param $id
     */
    public static function getFriendLink($id){
        return self::getInstance()->get($id);
    }

    /**
     * @descrpition 获取列表
     * @param $id
     */
    public static function getFriendLinkList(){
        return self::getInstance()->getList();
    }

}