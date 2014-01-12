<?php
/**
 * 菜单分类页
 * Class Article
 * Created by Lane.
 * Author: lane
 * Mail lixuan868686@163.com
 * Date: 14-1-10
 * Time: 下午4:22
 */
class Menu extends Controller{
	/**
	 * 构造函数
	 */
	public function __construct($param=array()){
		parent::__construct($param);
	}
	
	/**
	 * 分类页面
	 */
	public function main(){
//		$mid = Request::getRequest('mid', 'int', 0);
//        if(empty($articleId)){
//            return MsgCommon::returnErrMsg(MsgConstant::ERROR_MENU_NOT_EXISTS, '分类不存在');
//        }
//        $articleList = ArticleBusiness::getArticleByMid($mid);
//        foreach ($articleList as $article){
//            $article = htmlspecialchars_decode($article['title']);
//            $article = htmlspecialchars_decode($article['description']);
//            $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
//        }
//        View::assign('articleList', $articleList);
//        View::showFrontTpl('');
		View::showFrontTpl('menu');
	}
}