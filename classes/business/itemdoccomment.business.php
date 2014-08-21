<?php
/**
 *
 * 项目手册 - 评论管理
 *
 * Created by Lane.
 * @Class TagBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-8-20
 * @Time: 上午11:54
 * Blog http://www.lanecn.com
 */
class ItemDocCommentBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return ItemDocCommentDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new ItemDocCommentDbModel();
        }
        return self::$dbModelObj;
    }

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public static function setComment($fields){
        return self::getInstance()->add($fields);
    }

    /**
     * @descrpition 删除数据
     * @param $fields
     */
    public static function delComment($id){
        return self::getInstance()->del($id);
    }

    /**
     * @descrpition 通过MID获取
     * @param $id
     */
    public static function getCommentByAid($aid, $item=ITEM){
        return self::getInstance()->getByAid($aid, $item);
    }

    /**
     * 获取带分页的全部评论列表
     */
    public static function getCommentListPage($page){
        return self::getInstance()->getCommentListPage($page);
    }
}