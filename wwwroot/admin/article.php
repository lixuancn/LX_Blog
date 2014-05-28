<?php
/**
 * 文章管理
 * Created by Lane.
 * @Class Article
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class Article extends AdminController{

    public function __construct($param){
        parent::__construct($param);
    }

    /**
     * @descrpition 文章列表
     */
    public function lists(){
        //获取当前页码
        $page = 1;
        if(isset($this->param['page'])){
            $page = $this->param['page'];
        }
        $articleList = ArticleBusiness::getArticleList($page);
        $pageNav = $articleList['page_nav'];
        $articleList = $articleList['data'];

        View::assign('pageNav', $pageNav);
        View::assign('articleList', $articleList);
        View::showAdminTpl('article_list');
    }

    /**
     * @descrpition 添加文章
     */
    public function add(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/article/add/';
            $fields = array();
            $fields['title'] = Request::getRequest('title', 'str');
            $fields['seo_title'] = Request::getRequest('seo_title', 'str');
            $fields['seo_description'] = Request::getRequest('seo_description', 'str');
            $fields['seo_keywords'] = Request::getRequest('seo_keywords', 'str');
            $fields['author'] = Request::getRequest('author', 'str');
            $fields['description'] = Request::getRequest('description', 'str');
            $fields['clicks'] = Request::getRequest('clicks', 'str');
            $fields['tag'] = Request::getRequest('tag', 'str');
            $fields['good_num'] = Request::getRequest('good_num', 'str');
            $fields['bad_num'] = Request::getRequest('bad_num', 'str');
            $fields['ctime'] = Request::getRequest('ctime', 'str');
            $fields['ctime'] = strtotime($fields['ctime']);
            $fields['mid'] = Request::getRequest('mid', 'str');
            $fields['content'] = Request::getRequest('content', 'str');
            //将TAG记录进TAG表
            $tags = explode('|', $fields['tag']);
            foreach($tags as $tag){
                $tagInfo = TagBusiness::getTagByTag($tag);

                if(!empty($tagInfo)){
                    $tagInfo['num']++;
                    TagBusiness::editTag($tagInfo['id'], $tagInfo);
                }else{

                    $tagFields['tag'] = $tag;
                    $tagFields['num'] = 1;
                    TagBusiness::setTag($tagFields);
                }
            }
            $result = ArticleBusiness::setArticle($fields);
            if($result){
                View::showAdminMessage('/admin.php/article/lists', '添加成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '添加失败');
            }

        }
        $blogMenuList = MenuBusiness::getMenuList();
        $blogMenuList = Func::arrayKey($blogMenuList);
        $blogMenuList = Func::categoryTree($blogMenuList);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('article_add');
    }

    /**
     * @descrpition 修改文章
     */
    public function edit(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/article/edit/id-'.$this->param['id'];
            $fields = array();
            $fields['title'] = Request::getRequest('title', 'str');
            $fields['seo_title'] = Request::getRequest('seo_title', 'str');
            $fields['seo_description'] = Request::getRequest('seo_description', 'str');
            $fields['seo_keywords'] = Request::getRequest('seo_keywords', 'str');
            $fields['author'] = Request::getRequest('author', 'str');
            $fields['description'] = Request::getRequest('description', 'str');
            $fields['clicks'] = Request::getRequest('clicks', 'str');
            $fields['tag'] = Request::getRequest('tag', 'str');
            $fields['good_num'] = Request::getRequest('good_num', 'str');
            $fields['bad_num'] = Request::getRequest('bad_num', 'str');
            $fields['ctime'] = Request::getRequest('ctime', 'str');
            $fields['ctime'] = strtotime($fields['ctime']);
            $fields['mid'] = Request::getRequest('mid', 'str');
            $fields['content'] = Request::getRequest('content', 'str');
            //将TAG记录进TAG表
            $tags = explode('|', $fields['tag']);
            foreach($tags as $tag){
                $tagInfo = TagBusiness::getTagByTag($tag);

                if(!empty($tagInfo)){
                    $tagInfo['num']++;
                    TagBusiness::editTag($tagInfo['id'], $tagInfo);
                }else{

                    $tagFields['tag'] = $tag;
                    $tagFields['num'] = 1;
                    TagBusiness::setTag($tagFields);
                }
            }
            $result = ArticleBusiness::editArticle($this->param['id'], $fields);
            if($result){
                View::showAdminMessage('/admin.php/article/lists', '修改成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '修改失败');
            }
        }
        $blogMenuList = MenuBusiness::getMenuList();
        $blogMenuList = Func::arrayKey($blogMenuList);
        $blogMenuList = Func::categoryTree($blogMenuList);
        $article = ArticleBusiness::getArticle($this->param['id']);
        View::assign('article', $article);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('article_edit');
    }

    /**
     * @descrpition 删除文章
     */
    public function delete(){
        ArticleBusiness::delArticle($this->param['id']);
        View::showAdminMessage('/admin.php/article/lists', "删除文章成功!");
    }

    /**
     * Description: 生成sitemap.xml 空行请不要删除
     */
    public function buildSitemap(){
        $f = fopen(ROOT_PATH.'sitemap.xml', 'w+');
        $content = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<urlset>
EOF;
        //获取分类列表
        $menuList = MenuBusiness::getMenuList();
        foreacH($menuList as $menu){
            $menuXml = <<<EOF

    <url>
        <loc>%s</loc>
        <lastmod>%s</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
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
        <priority>1.0</priority>
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