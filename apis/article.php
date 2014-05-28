<?php
/**
 * 文章详细页
 *
 * Created by Lane.
 * @Class Article
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
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
    	$articleId = $this->param['aid'];
        if(empty($articleId)){
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_ARTICLE_NOT_EXISTS, '文章ID为空');
        }

        //获取文章信息
        $article = ArticleBusiness::getArticle($articleId);
        $article['author'] = htmlspecialchars_decode($article['author']);
        $article['title'] = htmlspecialchars_decode($article['title']);
        $article['description'] = htmlspecialchars_decode($article['description']);
        $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
        $article['tag'] = explode('|', $article['tag']);

        //获取该文章的评论
        $commentList = CommentBusiness::getCommentByAid($this->param['aid']);
        //获取该分类下热门文章
        $articleHotList = ArticleBusiness::getHotListByMid($article['mid']);
        foreach($articleHotList as $k=>$a){
            $articleHotList[$k]['title'] = mb_substr($a['title'], 0, 30, 'UTF-8') . '...';
        }

        //获取该分类下最新评论
        $commentNewList = CommentBusiness::getNewListByMid($article['mid']);
        foreach($commentNewList as $k=>$comment){
            $commentNewList[$k]['content'] = mb_substr($comment['content'], 0, 30, 'UTF-8') . '...';
        }

        //获取Tag
        $tags = TagBusiness::getRandList(ParamConstant::PARAM_TAG_LIST_NUM);

        //对文章进行处理，代码部分特殊显示.
        $article['content'] = preg_replace('/\[code\]/s', '<pre class="prettyprint linenums">', $article['content']);
        $article['content'] = preg_replace('/\[\/code\]/s', '</pre>', $article['content']);

        //SEO的title，keywords，description
        $seo_title = $article['seo_title'];
        $seo_description = $article['seo_description'];
        $seo_keywords = $article['seo_keywords'];

        //文章的点击数+1
        ArticleBusiness::clicks($articleId);

        View::assign('seo_title', $seo_title);
        View::assign('seo_description', $seo_description);
        View::assign('seo_keywords', $seo_keywords);
        View::assign('tags', $tags);
        View::assign('commentList', $commentList);
        View::assign('commentNewList', $commentNewList);
        View::assign('articleHotList', $articleHotList);
        View::assign('article', $article);
        View::showFrontTpl('article');
    }

    /**
     * @descrpition 添加评论
     */
    public function addcomment(){
        //判断验证码
        $captcha = Request::getSession('captcha');
        if($captcha != strtolower($this->param['captcha'])){
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_CAPTCHA_ERROR, '验证码错误');
        }
        $jumpUrl = GAME_URL . 'article/main/aid-'.$this->param['aid'];
        if(empty($this->param['aid']) || empty($this->param['mid']) || empty($this->param['nickname']) || empty($this->param['content'])){
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_REQUIRED_FIELDS, '必填项未填写全');
        }
        $fields = array();
        $fields['aid'] = $this->param['aid'];
        $fields['mid'] = $this->param['mid'];
        $fields['nickname'] = $this->param['nickname'];
        $fields['email'] = $this->param['email'];
        $fields['website'] = $this->param['website'];
        $fields['ctime'] = time();
        $fields['content'] = $this->param['content'];
        CommentBusiness::setComment($fields);
        View::showMessage($jumpUrl, '成功！');
    }

    /**
     * Description: 评分
     */
    public function score(){
        $articleId = $this->param['article_id'];
        $score = $this->param['score'];

        if($score == 1){
            $result = ArticleBusiness::goodNum($articleId);
        }else if($score == 2){
            $result = ArticleBusiness::badNum($articleId);
        }else{
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_USER_ILLEGAL_OPERATION, '非法操作');
        }
        if($result){
            View::showMessage('', '成功！');
        }else{
            View::showErrorMessage('', '失败！');
        }
    }
}