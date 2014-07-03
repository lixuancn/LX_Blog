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

    /**
     * Description: 生成sitemap.xml 空行请不要删除
     */
    public function buileSitemap(){
        $f = fopen(ROOT_PATH.'sitemap.xml', 'w+');
        $content = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<urlset>
EOF;
        //首页信息
        $indexXml = <<<EOF

    <url>
        <loc>%s</loc>
        <lastmod>%s</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
EOF;
        $content .= sprintf($indexXml, GAME_URL, date('Y-m-d'));
        //获取分类列表
        $menuList = MenuBusiness::getMenuList();
        foreacH($menuList as $menu){
            $menuXml = <<<EOF

    <url>
        <loc>%s</loc>
        <lastmod>%s</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
EOF;
            $content .= sprintf($menuXml, GAME_URL.'menu/main/mid-'.$menu['id'], date('Y-m-d'));
        }
        //获取文章列表
        $articleList = ArticleBusiness::getAllList();
        foreach($articleList as $article){
            $articleXML = <<<EOF

    <url>
        <loc>%s</loc>
        <lastmod>%s</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
EOF;
            $content .= sprintf($articleXML, GAME_URL.'article/main/aid-'.$article['id'], date('Y-m-d', $article['ctime']));
        }
        $content .= '
</urlset>';
        $result = fwrite($f, $content);
        fclose($f);
    }
}

