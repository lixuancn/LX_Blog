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
            View::showErrorMessage(GAME_URL, '参数错误');
        }

        //获取文章信息
        $article = ArticleBusiness::getArticle($articleId);
        if(empty($article)){
            View::showErrorMessage(GAME_URL, '内容丢掉了-.-');
        }
        $article['author'] = $article['author'];
        $article['title'] = $article['title'];
        $article['description'] = $article['description'];
        $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
        $article['tag'] = explode('|', $article['tag']);
//        $article['content'] = htmlspecialchars_decode($article['content']);

//        preg_match_all("/\[code\](.*?)\[\/code\]/s",  $article['content'], $match);
//
//        $article['content'] =  preg_replace("/\[code\](.*?)\[\/code\]/s", htmlspecialchars('${1}'), $article['content']);

        //获取该文章的评论
        $commentList = CommentBusiness::getCommentByAid($this->param['aid']);
        $commentList = Func::arrayKey($commentList);
        //将评论二级分类
        foreach($commentList as $key=>$comment){
            if($comment['cid'] != 0){
                $commentList[$comment['cid']]['son'][] = $comment;
                unset($commentList[$key]);
            }
        }
        //获取该分类下热门文章
        $articleHotList = ArticleBusiness::getHotListByMid($article['mid']);
        foreach($articleHotList as $k=>$a){
            $articleHotList[$k]['title'] = mb_substr($a['title'], 0, 30, 'UTF-8') . '...';
        }

        //获取该分类下最新评论
        $commentNewList = CommentBusiness::getNewListByMid($article['mid']);
        foreach($commentNewList as $key=>$comment){
            $commentNewList[$key]['content'] = mb_substr($commentNewList[$key]['content'], 0, 30, 'UTF-8') . '...';
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
        $userLog = array(
            'param'=>array('request'=>$_REQUEST, 'id'=>Request::getClientIP()),
            'method'=>__METHOD__,
            'create_time'=>date('Y-m-d H:i:s'),
        );
        UserLogBusiness::set($userLog);

        $jumpUrl = GAME_URL . 'article/main/aid-'.$this->param['aid'];
        //判断验证码
        $captcha = Request::getSession('captcha');
        if(empty($captcha) || $captcha !== strtolower($this->param['captcha'])){
            View::showErrorMessage($jumpUrl, '验证码错误');
        }
        if(empty($this->param['aid']) || empty($this->param['mid']) || empty($this->param['nickname']) || empty($this->param['content'])){
            View::showErrorMessage($jumpUrl, '必填项未填写全');
        }
        $fields = array();

        $fields['cid'] = Request::getRequest('cid', 'int');
        $fields['aid'] = Request::getRequest('aid', 'int');
        $fields['mid'] = Request::getRequest('mid', 'int');
        $fields['nickname'] = Request::getRequest('nickname', 'str');
        $fields['email'] = Request::getRequest('email', 'str');
        $fields['website'] = Request::getRequest('website', 'str');
        $fields['ctime'] = time();
        $fields['content'] = Request::getRequest('content', 'str');
        CommentBusiness::setComment($fields);
        //如果是回复别人的回复，则发送邮件提醒
        if(EMAIL_SENT_FOR_REPLY && $fields['cid'] > 0){
            //根据CID查询评论的详细信息
            $comment = CommentBusiness::getComment($fields['cid']);
            if(!empty($comment['email'])){
                $url = 'http://www.lanecn.com/article/main/aid-'.$comment['aid'];
                $title = '您的评论有了新回复【来自LaneBlog的系统邮件提醒】';
                $content = "\n";
                $content .= '<a href="'.$url.'">你的评论有了新的回复！请点击查看<a/>';
                $content .= "\n\n连接无效请复制到浏览器地址栏访问：".$url;
                $content .= "\n\nPs：系统发送，请勿直接回复！";

                $config = array(
                    "from" => EMAIL_ADDRESS,
                    "to" => $comment['email'],
                    "subject" => $title,
                    "body" => $content,
                    "username" => EMAIL_ADDRESS,
                    "password" => EMAIL_PASSWORD,
                    //"isHTML" => true
                );
                $mail = new MailSocket();
                $mail->setServer(EMAIL_SMTP);
                $mail->setMailInfo($config);
//                $result = Mail::quickSent($comment['email'], $title, $content, EMAIL_ADDRESS, EMAIL_PASSWORD);
            }
        }
        $userLog = array(
            'param'=>array('request'=>$_REQUEST, 'id'=>Request::getClientIP()),
            'method'=>__METHOD__,
            'create_time'=>date('Y-m-d H:i:s'),
            'result' => $fields,
        );
        $userLog['param'] = json_encode($userLog['param']);
        $userLog['result'] = json_encode($userLog['result']);
        UserLogBusiness::set($userLog);
        View::showMessage($jumpUrl, '成功！');
    }

    /**
     * Description: 评分
     */
    public function score(){
        $articleId = Request::getRequest('article_id', 'int', 58);
        $score = Request::getRequest('score', 'int', 1);
        //判断参数
        if($score != 1 && $score != 2){
            View::showErrorMessage(GAME_URL, '非法操作');
        }
        //返回
        $data = array();
        //判断是否24小时内已经投过了。cookie判断，伪验证。
        $addScore = Request::getCookie('add_score');
        if(!empty($addScore) && $addScore - time() <= 86400){
            $data['status'] = -2;
            $data['msg'] = '<p class="text-center">说你呢-.-</p><p class="text-center">不要贪得无厌哦</p><p class="text-center">24小时内只能顶一次';
            return json_encode($data);
        }
        Response::setCookie('add_score', time(), time() + 86400);
        //更新数据库
        if($score == 1){
            $result = ArticleBusiness::goodNum($articleId);
        }else if($score == 2){
            $result = ArticleBusiness::badNum($articleId);
        }
        //整理返回值
        if($result){
            $data['status'] = 0;
            $data['msg'] = 1;
        }else{
            $data['status'] = -1;
            $data['msg'] = '不明所以的失败了，请重新。';
        }
        return json_encode($data);
    }
}