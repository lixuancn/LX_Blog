<?php
/**
 * 首页
 * @Class Index
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */
class Index extends Controller{
	/**
	 * 构造函数
	 */
	public function __construct($param=array()){
		parent::__construct($param);
	}
	
    /**
     * @descrpition 首页
     */
    public function main(){
        //获取文章列表
        $articleList = ArticleBusiness::getNewList();
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
        //获取最热门文章
        $articleHotList = ArticleBusiness::getHotList();
        foreach($articleHotList as $k=>$article){
            $articleHotList[$k]['title'] = mb_substr($article['title'], 0, 30, 'UTF-8') . '...';
        }
        //获取最新评论
        $commentNewList = CommentBusiness::getNewList();
        foreach($commentNewList as $k=>$comment){
            $commentNewList[$k]['content'] = mb_substr($comment['content'], 0, 30, 'UTF-8') . '...';
        }
        //获取友情链接
        $friendLinkList = FriendLinkBusiness::getFriendLinkList();
        View::assign('friendLinkList', $friendLinkList);
        View::assign('articleHotList', $articleHotList);
        View::assign('commentNewList', $commentNewList);
        View::assign('articleList', $articleList);
        View::showFrontTpl('index');
    }
}

