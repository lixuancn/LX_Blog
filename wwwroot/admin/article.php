<?php
/**
 * 文章管理
 * Created by Lane.
 * @Class Article
 * @Author: lane
 * @Mail: lixuan868686@163.com
 */
class Article extends AdminController{

    public function __construct($param){
        parent::__construct($param);
    }

    public function lists(){
        $articleList = ArticleBusiness::getArticleList();
        View::assign('articleList', $articleList);
        View::showAdminTpl('article_list');
    }
}