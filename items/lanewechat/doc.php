<?php
/**
 * Created by PhpStorm.
 * User: lane
 * Date: 14-8-20
 * Time: 上午11:47
 * E-mail: lixuan868686@163.com
 * WebSite: http://www.lanecn.com
 */
class Doc extends Controller{
    /**
     * 构造函数
     */
    public function __construct($param=array()){
        parent::__construct($param);
    }
    /**
     * 手册首页
     */
    public function main(){
        $articleId = isset($this->param['aid']) ? $this->param['aid'] : 0;
        if(!$articleId){
            $article = ItemDocArticleBusiness::getOneMostOld();
        }else{
            //获取文章信息
            $article = ItemDocArticleBusiness::getArticle($articleId);
        }
        if(empty($article)){
            View::showErrorMessage(ITEM_DOMAIN, '内容丢掉了-.-');
        }
        $articleId = $article['id'];
        $article['ctime'] = date('Y-m-d H:i:s', $article['ctime']);
        $article['tag'] = empty($article['tag']) ? '' : explode('|', $article['tag']);
        //获取该文章的评论
        $commentList = ItemDocCommentBusiness::getCommentByAid($articleId);
        $commentList = Func::arrayKey($commentList);
        //将评论二级分类
        foreach($commentList as $key=>$comment){
            if($comment['cid'] != 0){
                $commentList[$comment['cid']]['son'][] = $comment;
                unset($commentList[$key]);
            }
        }

        //对文章进行处理，代码部分特殊显示.
        $article['content'] = preg_replace('/\[code\]/s', '<pre class="prettyprint linenums">', $article['content']);
        $article['content'] = preg_replace('/\[\/code\]/s', '</pre>', $article['content']);

        //SEO的title，keywords，description
        $seo_title = $article['seo_title'];
        $seo_description = $article['seo_description'];
        $seo_keywords = $article['seo_keywords'];

        //文章的点击数+1
        ItemDocArticleBusiness::clicks($articleId);

        //获取项目下的菜单列表
        $itemMenuList = ItemDocMenuBusiness::getMenuListByItem();
        $itemMenuList = Func::arrayKey($itemMenuList);
        //获取项目下的文章列表
        $itemArticleList = ItemDocArticleBusiness::getListByItem();
        foreach($itemArticleList as $itemArticle){
            if(isset($itemMenuList[$itemArticle['mid']])){
                $itemMenuList[$itemArticle['mid']]['article_list'][] = $itemArticle;
            }
        }

        View::assign('itemMenuList', $itemMenuList);
        View::assign('seo_title', $seo_title);
        View::assign('seo_description', $seo_description);
        View::assign('seo_keywords', $seo_keywords);
        View::assign('commentList', $commentList);
        View::assign('article', $article);
        View::showFrontTpl('doc');
    }

    /**
     * @descrpition 添加评论
     */
    public function addcomment(){
        $jumpUrl = ITEM_DOMAIN . 'doc/main/aid-'.$this->param['aid'];
        //判断验证码
        $captcha = Request::getSession('captcha');
        if($captcha != strtolower($this->param['captcha'])){
            View::showErrorMessage($jumpUrl, '验证码错误');
        }
        if(empty($this->param['aid']) || empty($this->param['item']) || empty($this->param['mid']) || empty($this->param['nickname']) || empty($this->param['content'])){
            View::showErrorMessage($jumpUrl, '必填项未填写全');
        }
        $fields = array();

        $fields['cid'] = Request::getRequest('cid', 'int');
        $fields['aid'] = Request::getRequest('aid', 'int');
        $fields['item'] = Request::getRequest('item', 'str');
        $fields['mid'] = Request::getRequest('mid', 'int');
        $fields['nickname'] = Request::getRequest('nickname', 'str');
        $fields['email'] = Request::getRequest('email', 'str');
        $fields['website'] = Request::getRequest('website', 'str');
        $fields['ctime'] = time();
        $fields['content'] = Request::getRequest('content', 'str');
        ItemDocCommentBusiness::setComment($fields);

        //如果是回复别人的回复，则发送邮件提醒
        if(EMAIL_SENT_FOR_REPLY && $fields['cid'] > 0){
            //根据CID查询评论的详细信息
            $comment = CommentBusiness::getComment($fields['cid']);
            if(!empty($comment['email'])){
                $url = 'http://lanewechat.lanecn.com/doc/main/aid-'.$comment['aid'];
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

        View::showMessage($jumpUrl, '成功！');
    }

    /**
     * Description: 评分
     */
    public function score(){
        $articleId = Request::getRequest('article_id', 'int', 58);
        $item = Request::getRequest('item', 'str');
        $score = Request::getRequest('score', 'int', 1);
        //判断参数
        if(($score != 1 && $score != 2) || empty($item)){
            View::showErrorMessage(ITEM_DOMAIN, '非法操作');
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
            $result = ItemDocArticleBusiness::goodNum($articleId);
        }else if($score == 2){
            $result = ItemDocArticleBusiness::badNum($articleId);
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