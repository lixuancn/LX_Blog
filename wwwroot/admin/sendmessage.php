<?php
/**
 * 发送客服消息oJaejjuVn-JgW5waxPOIe_o3vdl0
 * Created by PhpStorm.
 * User: lane
 * Date: 14-1-3
 * Time: 下午2:09
 */
class SendMessage extends AdminController{

    /**
     * @descrpition 文本
     */
    public function sendText(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/sendmessage/sendText';
            $tousername = Request::getRequest('tousername', 'str');
            $content = Request::getRequest('content', 'str');
            $result = ResponseInitiativeBusiness::text($tousername, $content);
            if(empty($result['errcode']) || (isset($result['errcode']) && $result['errcode'] != 0)){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                View::showMessage($jumpurl, '成功!');
            }
        }
        View::showAdminTpl('send_message_text');
    }

    /**
     * @descrpition 图像
     */
    public function sendImage(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/sendmessage/sendImage';
            $tousername = Request::getRequest('tousername', 'str');
            $mediaId = Request::getRequest('mediaId', 'str');
            $result = ResponseInitiativeBusiness::image($tousername, $mediaId);
            if(empty($result['errcode']) || (isset($result['errcode']) && $result['errcode'] != 0)){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                View::showMessage($jumpurl, '成功!');
            }
        }
        View::showAdminTpl('send_message_image');
    }

    /**
     * @descrpition 语音
     */
    public function sendVoice(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/sendmessage/sendVoice';
            $tousername = Request::getRequest('tousername', 'str');
            $mediaId = Request::getRequest('mediaId', 'str');
            $result = ResponseInitiativeBusiness::voice($tousername, $mediaId);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                View::showMessage($jumpurl, '成功!');
            }
        }
        View::showAdminTpl('send_message_voice');
    }

    /**
     * @descrpition 视频
     */
    public function sendVideo(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/sendmessage/sendVideo';
            $tousername = Request::getRequest('tousername', 'str');
            $mediaId = Request::getRequest('mediaId', 'str');
            $title = Request::getRequest('title', 'str');
            $description = Request::getRequest('description', 'str');
            $result = ResponseInitiativeBusiness::video($tousername, $mediaId, $title, $description);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                View::showMessage($jumpurl, '成功!');
            }
        }
        View::showAdminTpl('send_message_video');
    }

    /**
     * @descrpition 音乐
     */
    public function sendMusic(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/sendmessage/sendMusic';
            $tousername = Request::getRequest('tousername', 'str');
            $title = Request::getRequest('title', 'str');
            $description = Request::getRequest('description', 'str');
            $musicUrl = Request::getRequest('musicUrl', 'str');
            $hqMusicUrl = Request::getRequest('hqMusicUrl', 'str');
            $thumbMediaId = Request::getRequest('thumbMediaId', 'str');
            $result = ResponseInitiativeBusiness::music($tousername, $title, $description, $musicUrl, $hqMusicUrl, $thumbMediaId);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                View::showMessage($jumpurl, '成功!');
            }
        }
        View::showAdminTpl('send_message_music');
    }

    /**
     * @descrpition 图文
     */
    public function sendNews(){
        if (Request::getRequest('dosubmit', 'str')) {
            $jumpurl = '/admin.php/sendmessage/sendNews';
            $tousername = Request::getRequest('tousername', 'str');
            $title = Request::getRequest('title', 'str');
            $description = Request::getRequest('description', 'str');
            $picUrl = Request::getRequest('picUrl', 'str');
            $url = Request::getRequest('url', 'str');
            $title = explode(',', $title);
            $description = explode(',', $description);
            $picUrl = explode(',', $picUrl);
            $url = explode(',', $url);
            $item = array();
            $count = count($title) + count($description) + count($picUrl) + count($url);
            $average = $count / 4;
            if($count <= 0 || count($title) != $average || count($description) != $average || count($picUrl) != $average || count($url) != $average){
                View::showErrorMessage($jumpurl, '请阅读说明后按照规则填写!');
            }
            for ($i=0; $i<$average; $i++){
                $item[] = ResponseInitiativeBusiness::newsItem($title[$i], $description[$i], $picUrl[$i], $url[$i]);
            }
            $result = ResponseInitiativeBusiness::news($tousername, $item);
            if(isset($result['errcode']) && $result['errcode'] != 0){
                $content =  $result['errmsg'];
                View::showErrorMessage($jumpurl, '出错了!'.$content);
            }else{
                View::showMessage($jumpurl, '成功!');
            }
        }
        View::showAdminTpl('send_message_news');
    }
}