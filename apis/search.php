<?php
/**
 * 站内搜索页面
 * Class Search
 * Created by Lane.
 * Author: lane
 * Mail lixuan868686@163.com
 * Date: 14-1-10
 * Time: 下午4:22
 * Blog http://www.lanecn.com
 */
class Search extends Controller{
	/**
	 * 构造函数
	 */
	public function __construct($param=array()){
		parent::__construct($param);
	}
	
	/**
     * @descrpition 搜索
     */
    public function main(){
    	if(isset($this->param['keywords'])){
    		$keywords = $this->param['keywords'];
            $keywords = urldecode($keywords);
    		View::assign('keywords', $keywords);
    	}
        $page = 1;
        if(isset($this->param['page'])){
            $page = $this->param['page'];
        }
        //获取文章列表
        $articleList = ArticleBusiness::search($keywords, $page);
        $pageNav = $articleList['page_nav'];
        $articleList = $articleList['data'];
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
        //获取最新评论
        $commentNewList = CommentBusiness::getNewList();
        foreach($commentNewList as $key=>$comment){
            $commentNewList[$key]['content'] = mb_substr($comment['content'], 0, 30, 'UTF-8') . '...';
        }

        //获取Tag
        $tags = TagBusiness::getRandList(ParamConstant::PARAM_TAG_LIST_NUM);

        //SEO的title，keywords，description
        $seo_title = $seo_keywords = $seo_description = $keywords.' 搜索';

        View::assign('seo_title', $seo_title);
        View::assign('seo_description', $seo_description);
        View::assign('seo_keywords', $seo_keywords);

        View::assign('tags', $tags);
        View::assign('articleHotList', $articleHotList);
        View::assign('commentNewList', $commentNewList);
        View::assign('pageNav', $pageNav);
        View::assign('articleList', $articleList);
        View::showFrontTpl('search');
    }
}