<?php
/**
 * 用户权限验证.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-9-8 
 * @version $Id: auth.common.php 802 2013-09-22 02:46:09Z manling $
 */
 
class AuthCommon{
    /**
     * @descrpition 检测队列权限
     * @return array|bool
     */
    public static function checkQueueAuth(){
		$key = urldecode(Request::getRequest('key', 'str'));
		$kid = Request::getRequest('kid', 'str');
		$logtime = Request::getRequest('logtime', 'str');
		$params = urldecode(Request::getRequest('params', 'str'));
		
		if (empty($kid) || empty($key) || $key != Func::madeQueueKey($kid, $logtime, $params)) {
			return false;
		}
		$params = json_decode(base64_decode($params), true);

		
		return array('kid'=>$kid, 'params'=>$params);
 	}

    /**
     * @descrpition 获取微信ACCESS_TOKEN
     * @return Ambigous|bool
     */
    public static function getAccessToken(){
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.WECHAT_APPID.'&secret='.WECHAT_APPSECRET;
        $accessToken = CurlBusiness::callWebServer($url, '', 'GET');
        if(!isset($accessToken['access_token'])){
            return MsgCommon::returnErrMsg(MsgConstant::ERROR_GET_ACCESS_TOKEN, '获取ACCESS_TOKEN失败');
        }
        $accessToken['time'] = time();
        //存入SESSION
        Response::setSession('wechat_access_token', $accessToken);
        return $accessToken;
    }

    /**
     * @descrpition 检测微信ACCESS_TOKEN是否过期
     *              -10是预留的网络延迟时间
     * @return bool
     */
    public static function checkAccessToken(){
        //获取SESSION
        $accessToken = Request::getSession('wechat_access_token');
        if(!empty($accessToken) && time() - $accessToken['time'] < $accessToken['expires_in']-10){
            return $accessToken;
        }
        return false;
    }
}
?>