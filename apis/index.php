<?php
/**
 * 首页
 * @Class Index
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
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
            $articleList[$k]['author'] = $article['author'];
            $articleList[$k]['title'] = $article['title'];
            $articleList[$k]['description'] = $article['description'];
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
        //获取全站推荐文章
        $articleAllSiteRecommend = ArticleBusiness::getListByRecommendType(ParamConstant::PARAM_ARTICLE_RECOMMEND_TYPE_ALL_SITE, '0, 5');
        foreach($articleAllSiteRecommend as &$article){
            $article['title'] = mb_substr($article['title'], 0, 30, 'UTF-8') . '...';
        }
        //获取首页推荐
        $articleIndexRecommend = ArticleBusiness::getListByRecommendType(ParamConstant::PARAM_ARTICLE_RECOMMEND_TYPE_INDEX, '0, 5');
        foreach($articleIndexRecommend as &$article){
            $article['title'] = mb_substr($article['title'], 0, 30, 'UTF-8') . '...';
        }
        //获取最新评论
        $commentNewList = CommentBusiness::getNewList();
        foreach($commentNewList as $key=>$comment){
            $commentNewList[$key]['content'] = mb_substr($comment['content'], 0, 30, 'UTF-8') . '...';
        }
        //获取Tag
        $tags = TagBusiness::getRandList(ParamConstant::PARAM_TAG_LIST_NUM);
        //获取友情链接
        $friendLinkList = FriendLinkBusiness::getFriendLinkList();
        View::assign('friendLinkList', $friendLinkList);
        View::assign('tags', $tags);
        View::assign('articleHotList', $articleHotList);
        View::assign('articleAllSiteRecommend', $articleAllSiteRecommend);
        View::assign('articleIndexRecommend', $articleIndexRecommend);
        View::assign('commentNewList', $commentNewList);
        View::assign('articleList', $articleList);
        View::showFrontTpl('index');
    }
}