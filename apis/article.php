<?php
/**
 * Description 文章类。用于WEB展示
 * Class Article
 * Created by Lane.
 * Mail lixuan868686@163.com
 */
class Article{
    /**
     * @descrpition 单篇文章展示
     * @return Ambigous
     */
    public function get_by_id(){
        $articleId = Request::getRequest('id', 'int', 0);
        if(empty($articleId)){
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_ARTICLE_NOT_EXISTS, '文章ID为空');
        }
        $article = ArticleBusiness::getArticle($articleId);
        $article = htmlspecialchars_decode($article['content']);
        $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
        View::assign('article', $article);
        View::showFrontTpl('');
    }

    /**
     * @descrpition 分类文章展示
     * @return Ambigous
     */
    public function get_by_mid(){
        $mid = Request::getRequest('mid', 'int', 0);
        if(empty($articleId)){
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_MENU_NOT_EXISTS, '分类不存在');
        }
        $articleList = ArticleBusiness::getArticleByMid($mid);
        foreach ($articleList as $article){
            $article = htmlspecialchars_decode($article['title']);
            $article = htmlspecialchars_decode($article['description']);
            $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
        }
        View::assign('articleList', $articleList);
        View::showFrontTpl('');
    }
}