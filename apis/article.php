<?php
/**
 * 文章详细页
 * Class Article
 * Created by Lane.
 * Author: lane
 * Mail lixuan868686@163.com
 * Date: 14-1-10
 * Time: 下午4:22
 */
class Article extends Controller{
	/**
	 * 构造函数
	 */
	public function __construct($param=array()){
		parent::__construct($param);
	}
    /**
     * @descrpition 单篇文章展示
     * @return Ambigous
     */
    public function main(){
//    	$articleId = $this->param['id'];
//        if(empty($articleId)){
//            return MsgCommon::returnErrMsg(MsgConstant::ERROR_ARTICLE_NOT_EXISTS, '文章ID为空');
//        }
//        $article = ArticleBusiness::getArticle($articleId);
//        $article = htmlspecialchars_decode($article['content']);
//        $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
//        View::assign('article', $article);
        View::showFrontTpl('article');
    }
}