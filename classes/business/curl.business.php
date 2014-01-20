<?php
/**
 *
 * CURL工具
 *
 * Class CurlBusiness
 * Created by Lane.
 * @Author: lane
 * @Mail: lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */
class CurlBusiness {
    /**
     * 调用外部url
     * @param $queryUrl
     * @param $param
     * @param string $method
     * @return bool|mixed
     */
    public static function callWebServer($queryUrl, $param, $method='get') {
        if (empty($queryUrl)) {
            return false;
        }
        $method = strtolower($method);
        $ret = '';
        $param = empty($param) ? array() : $param;
        $curlObj = new Curl();
        if ($method == 'get') {
            $ret = $curlObj->httpGet($queryUrl, GAME_URL, $param);
        } elseif($method == 'post') {
            $ret = $curlObj->httpPost($queryUrl, GAME_URL, $param);
        }
        if(!empty($ret)){
            return json_decode($ret, true);
        }
        return true;
    }

}

?>
