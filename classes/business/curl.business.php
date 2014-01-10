<?php
/**
 * Description CURL工具
 * Class GmToolsBusiness
 * Created by Lane.
 * Mail lixuan868686@163.com
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
            $ret = $curlObj->httpGet($queryUrl, '', $param);
        } elseif($method == 'post') {
            $ret = $curlObj->httpPost($queryUrl, '', $param);
        }
        if(!empty($ret)){
            return json_decode($ret, true);
        }
        return true;
    }

}

?>
