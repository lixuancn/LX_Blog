<?php
/**
 *
 * 项目手册 - 文章管理
 *
 * Created by Lane.
 * @Class TagBusiness
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-8-20
 * @Time: 上午11:54
 * Blog http://www.lanecn.com
 */
class ItemDocArticleBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return ItemDocArticleDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new ItemDocArticleDbModel();
        }
        return self::$dbModelObj;
    }

    /**
     * @descrpition 添加数据
     * @param $fields
     */
    public static function setArticle($fields){
        return self::getInstance()->add($fields);
    }

    /**
     * @descrpition 修改数据
     * @param $id
     * @param $fields
     */
    public static function editArticle($id, $fields){
        return self::getInstance()->edit($id, $fields);
    }

    /**
     * @descrpition 删除数据
     * @param $fields
     */
    public static function delArticle($id){
        //删除相关评论
        CommentBusiness::delCommentByAid($id);
        //删除文章
        return self::getInstance()->del($id);
    }

    /**
     * @descrpition 通过ID获取
     * @param $id
     */
    public static function getArticle($id){
        return self::getInstance()->get($id);
    }

    /**
     * @descrpition 获取项目下的列表
     * @param $id
     */
    public static function getListByItem($item=ITEM){
        return self::getInstance()->getListByItem($item);
    }

    /**
     * @descrpition 获取列表
     * @param $id
     */
    public static function getArticleList($page){
        return self::getInstance()->getList($page);
    }

    /**
     * Description: 点击数+1
     */
    public static function clicks($articleId, $item=ITEM){
        return self::getInstance()->clicks($articleId, $item);
    }

    /**
     * Description: 同意数+1
     */
    public static function goodNum($articleId, $item=ITEM){
        return self::getInstance()->goodNum($articleId, $item);
    }

    /**
     * Description: 反对数+1
     */
    public static function badNum($articleId, $item=ITEM){
        return self::getInstance()->badNum($articleId, $item);
    }

    public static function getListByWhere($where){
        return self::getInstance()->getListByWhere($where);
    }

    /**
     * 获取最旧的一个
     */
    public static function getOneMostOld($item = ITEM){
        $result = self::getInstance()->getOneMostOld($item);
        if($result){
            return $result[0];
        }
        return $result;
    }

}