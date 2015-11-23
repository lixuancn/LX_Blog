<?php
/**
 *
 * 用户日志
 *
 * Created by Lane.
 * @Class TagBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-8-20
 * @Time: 上午11:54
 * Blog http://www.lanecn.com
 */
class UserLogBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return UserLogDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new UserLogDbModel();
        }
        return self::$dbModelObj;
    }

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public static function set($fields){
        return self::getInstance()->add($fields);
    }

    /**
     * @descrpition 删除数据
     * @param $fields
     */
    public static function del($id){
        return self::getInstance()->del($id);
    }
}