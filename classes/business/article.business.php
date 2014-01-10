<?php
/**
 * 文章管理
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-3
 * Time: 下午9:54
 */
class ArticleBusiness{

    private static $dbModelObj;

    /**
     * 返回对象 ...
     * @return ArticleDbModel
     */
    public static function getInstance() {
        if (is_null(self::$dbModelObj) || !isset(self::$dbModelObj)) {
            self::$dbModelObj = new ArticleDbModel();
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
     * @descrpition 通过MID获取
     * @param $id
     */
    public static function getArticleByMid($mid){
        return self::getInstance()->getByMid($mid);
    }

    /**
     * @descrpition 获取列表
     * @param $id
     */
    public static function getArticleList(){
        return self::getInstance()->getList();
    }

}