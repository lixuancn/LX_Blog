<?php
/**
 * 项目手册 - 文章管理
 * Created by Lane.
 * @Class Article
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * Blog http://www.lanecn.com
 */
class ItemDocArticle extends AdminController{

    public function __construct($param){
        parent::__construct($param);
    }

    /**
     * @descrpition 文章列表
     */
    public function lists(){
        //获取当前页码
        $page = isset($this->param['page']) && $this->param['page'] > 0 ? $this->param['page'] : 1;
        $articleList = ItemDocArticleBusiness::getArticleList($page);
        $pageNav = $articleList['page_nav'];
        $articleList = $articleList['data'];

        //获取前台分类信息
        $menuList = ItemDocMenuBusiness::getMenuList();
        $menuList = Func::arrayKey($menuList);
        //整理数据
        foreach($articleList as &$article){
            //获取分类名
            $article['mid'] = $menuList[$article['mid']]['name'];
        }
        View::assign('pageNav', $pageNav);
        View::assign('articleList', $articleList);
        View::showAdminTpl('item_doc_article_list');
    }

    /**
     * @descrpition 添加文章
     */
    public function add(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/itemdocarticle/add/';
            $fields = array();
            $fields['title'] = Request::getRequest('title', 'str');
            $fields['seo_title'] = Request::getRequest('seo_title', 'str');
            $fields['seo_description'] = Request::getRequest('seo_description', 'str');
            $fields['seo_keywords'] = Request::getRequest('seo_keywords', 'str');
            $fields['author'] = Request::getRequest('author', 'str');
            $fields['clicks'] = Request::getRequest('clicks', 'str');
            $fields['tag'] = Request::getRequest('tag', 'str');
            $fields['good_num'] = Request::getRequest('good_num', 'str');
            $fields['bad_num'] = Request::getRequest('bad_num', 'str');
            $fields['ctime'] = Request::getRequest('ctime', 'str');
            $fields['ctime'] = strtotime($fields['ctime']);
            $fields['mid'] = Request::getRequest('mid', 'int');
            $fields['item'] = Request::getRequest('item', 'str');
            $fields['content'] = Request::getRequest('content', 'str');
            //如果使用UEditor，则反转义一次
            $fields['content'] = htmlspecialchars_decode($fields['content']);
            //将TAG记录进TAG表
            $tags = explode('|', $fields['tag']);
            foreach($tags as $tag){
                if(empty($tag)) continue;
                $tagInfo = ItemDocTagBusiness::getTagByTag($tag);
                if(!empty($tagInfo)){
                    $tagInfo['num']++;
                    ItemDocTagBusiness::editTag($tagInfo['id'], $tagInfo);
                }else{

                    $tagFields['tag'] = $tag;
                    $tagFields['num'] = 1;
                    ItemDocTagBusiness::setTag($tagFields);
                }
            }
            $result = ItemDocArticleBusiness::setArticle($fields);
            if($result){
                View::showAdminMessage('/admin.php/itemdocarticle/lists', '添加成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '添加失败');
            }

        }
        $blogMenuList = ItemDocMenuBusiness::getMenuList();
        $blogMenuList = Func::arrayKey($blogMenuList);
        $blogMenuList = Func::categoryTree($blogMenuList);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('item_doc_article_add');
    }

    /**
     * @descrpition 修改文章
     */
    public function edit(){
        if(Request::getRequest('dosubmit', 'str')){
            $jumpUrl = '/admin.php/itemdocarticle/edit/id-'.$this->param['id'];
            $fields = array();
            $fields['title'] = Request::getRequest('title', 'str');
            $fields['seo_title'] = Request::getRequest('seo_title', 'str');
            $fields['seo_description'] = Request::getRequest('seo_description', 'str');
            $fields['seo_keywords'] = Request::getRequest('seo_keywords', 'str');
            $fields['author'] = Request::getRequest('author', 'str');
            $fields['clicks'] = Request::getRequest('clicks', 'str');
            $fields['tag'] = Request::getRequest('tag', 'str');
            $fields['good_num'] = Request::getRequest('good_num', 'str');
            $fields['bad_num'] = Request::getRequest('bad_num', 'str');
            $fields['ctime'] = Request::getRequest('ctime', 'str');
            $fields['ctime'] = strtotime($fields['ctime']);
            $fields['mid'] = Request::getRequest('mid', 'int');
            $fields['item'] = Request::getRequest('item', 'str');
            $fields['content'] = Request::getRequest('content', 'str');
            //如果使用UEditor，则反转义一次
            $fields['content'] = htmlspecialchars_decode($fields['content']);
            //将TAG记录进TAG表
            $tags = explode('|', $fields['tag']);
            foreach($tags as $tag){
                if(empty($tag)) continue;
                $tagInfo = ItemDocTagBusiness::getTagByTag($tag);

                if(!empty($tagInfo)){
                    $tagInfo['num']++;
                    ItemDocTagBusiness::editTag($tagInfo['id'], $tagInfo);
                }else{

                    $tagFields['tag'] = $tag;
                    $tagFields['num'] = 1;
                    ItemDocTagBusiness::setTag($tagFields);
                }
            }
            $result = ItemDocArticleBusiness::editArticle($this->param['id'], $fields);
            if($result){
                View::showAdminMessage('/admin.php/itemdocarticle/lists', '修改成功');
            }else{
                View::showAdminErrorMessage($jumpUrl, '修改失败');
            }
        }
        $blogMenuList = ItemDocMenuBusiness::getMenuList();
        $blogMenuList = Func::arrayKey($blogMenuList);
        $blogMenuList = Func::categoryTree($blogMenuList);
        $article = ItemDocArticleBusiness::getArticle($this->param['id']);
        View::assign('article', $article);
        View::assign('blogMenuList', $blogMenuList);
        View::showAdminTpl('item_doc_article_edit');
    }

    /**
     * @descrpition 删除文章
     */
    public function delete(){
        ItemDocArticleBusiness::delArticle($this->param['id']);
        View::showAdminMessage('/admin.php/itemdocarticle/lists', "删除文章成功!");
    }

    /**
     * 获取评论列表
     */
    public function lists_comment(){
        $page = isset($this->param['page']) && $this->param['page'] > 0 ? $this->param['page'] : 1;
        $commentList = ItemDocCommentBusiness::getCommentListPage($page);
        $pageNav = $commentList['page_nav'];
        $commentList = $commentList['data'];
        $articleIdList = "";
        foreach($commentList as $comment){
            $articleIdList .= "`id` = '".$comment['id']."' OR ";
        }
        $articleIdList = substr($articleIdList, 0, -4);
        $articleList = ItemDocArticleBusiness::getListByWhere($articleIdList);
        $articleList = Func::arrayKey($articleList);
        foreach($commentList as &$comment){
            if(isset($articleList[$comment['aid']])){
                $comment['article_name'] = $articleList[$comment['aid']]['title'];
            }
        }

        View::assign('commentList', $commentList);
        View::assign('pageNav', $pageNav);
        View::showAdminTpl('article_comment_list');
    }

    /**
     * 删除评论
     */
    public function delete_comment(){
        ItemDocCommentBusiness::delComment($this->param['id']);
        View::showAdminMessage('/admin.php/itemdocarticle/lists_comment', "删除评论成功!");
    }
}