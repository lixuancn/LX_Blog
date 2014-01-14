<?php
/**
 * 菜单分类页
 * Class Menu
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
        //获取当前页码
        $page = 1;
        if(isset($this->param['page'])){
            $page = $this->param['page'];
        }
        //获取分类Id
        $mid = $this->param['mid'];
        //获取该分类下的文章
        $articleList = ArticleBusiness::getArticleByMid($mid, $page);
        $pageNav = $articleList['page_nav'];
        $articleList = $articleList['data'];
        foreach ($articleList as $k => $article){
            //整理数据
            $articleList[$k]['author'] = htmlspecialchars_decode($article['author']);
            $articleList[$k]['title'] = htmlspecialchars_decode($article['title']);
            $articleList[$k]['description'] = htmlspecialchars_decode($article['description']);
            $articleList[$k]['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
            $articleList[$k]['tag'] = explode('|', $article['tag']);
            if(empty($article['description'])){
                $articleList[$k]['description'] = mb_substr($article['content'], 0, 300, 'UTF-8');
            }else{
                $articleList[$k]['description'] = mb_substr($article['description'], 0, 300, 'UTF-8');
            }
        }

        //获取该分类下热门文章
        $articleHotList = ArticleBusiness::getHotListByMid($mid);
        foreach($articleHotList as $k=>$article){
            $articleHotList[$k]['title'] = mb_substr($article['title'], 0, 30, 'UTF-8') . '...';
        }

        //获取该分类下最新评论
        $commentNewList = CommentBusiness::getNewListByMid($mid);
        foreach($commentNewList as $k=>$comment){
            $commentNewList[$k]['content'] = mb_substr($comment['content'], 0, 30, 'UTF-8') . '...';
        }

        View::assign('commentNewList', $commentNewList);
        View::assign('articleHotList', $articleHotList);
        View::assign('pageNav', $pageNav);
        View::assign('articleList', $articleList);
		View::showFrontTpl('menu');
	}
}