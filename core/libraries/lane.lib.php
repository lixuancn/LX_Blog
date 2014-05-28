<?php
/**
 * 常用代码库
 * Created by PhpStorm.
 * User: lane
 * Date: 14-3-17
 * Time: 上午10:06
 */
class Lane{
    /**
     * Description: 根据经度纬度之间的距离
     * @param $latitude1 纬度1
     * @param $longitude1 经度1
     * @param $latitude2 纬度2
     * @param $longitude2 经度2
     * @return array
     */
    public static function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {
        $theta = $longitude1 - $longitude2;
        $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('miles','feet','yards','kilometers','meters');
    }

    /**
     * Description: 完善CURL功能
     * @param $url
     * @param null $ref referer 头信息中的referer
     * @param array $post
     * @param string $ua 用户代理
     * @param bool $print 是否打印
     * @return mixed
     */
    public static function xcurl($url,$ref=null,$post=array(),$ua="Mozilla/5.0 (X11; Linux x86_64; rv:2.2a1pre) Gecko/20110324 Firefox/4.2a1pre",$print=false) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        if(!empty($ref)) {
            curl_setopt($ch, CURLOPT_REFERER, $ref);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //是否输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($ua)) {
            curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        }
        if(count($post) > 0){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        if($print) {
            print($output);
        } else {
            return $output;
        }
    }

    /**
     * Description: 根据IP获取城市省份
     * @param $ip
     * @return string
     */
    public static function detect_city($ip) {

        $default = 'Hollywood, CA';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';
        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $curlopt_useragent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );

        curl_setopt_array($ch, $curl_opt);
        $content = curl_exec($ch);
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        curl_close($ch);
        if(preg_match('{City : ([^<]*)}i', $content, $regs) ){
            $city = $regs[1];
        }
        if(preg_match('{State/Province : ([^<]*)}i', $content, $regs)){
            $state = $regs[1];
        }
        if($city!='' && $state!='' ){
            $location = $city . ', ' . $state;
            return $location;
        }else{
            return $default;
        }
    }

    /**
     * Description: 检测浏览器的语言
     * @param $availableLanguages 可用的语言列表
     * @param string $default
     * @return string
     */
    public static function get_client_language($availableLanguages, $default='en'){

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {

            $langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

            //start going through each one
            foreach ($langs as $value){

                $choice=substr($value,0,2);
                if(in_array($choice, $availableLanguages)){
                    return $choice;

                }

            }
        }
        return $default;
    }

    /**
     * Description: 将文件数据BASE64编码
     * @param $file
     * @param $mime
     */
    public static function data_uri($file, $mime) {
        $contents=file_get_contents($file);
        $base64=base64_encode($contents);
        echo "data:$mime;base64,$base64";
    }

    /**
     * Description:
     * @param $title
     * @return mixed
     */
    public static function make_seo_name($title) {
        return preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));
    }

    /**
     * Description: 加密算法。返回127位
     * @param $hash 需要加密的串
     * @param $times 加密函数的运行次数
     * @return string
     */
    public static function fue($hash,$times) {
        // Execute the encryption(s) as many times as the user wants
        for($i=$times;$i>0;$i--) {
            // Encode with base64...
            $hash=base64_encode($hash);
            // and md5...
            $hash=md5($hash);
            // sha1...
            $hash=sha1($hash);
            // sha256... (one more)
            $hash=hash("sha256", $hash);
            // sha512
            $hash=hash("sha512", $hash);

        }
        return $hash;
    }

    /**
     * Description: 将PHP数组生成CSV文件
     * @param $data 需要生成的数组
     * @param string $delimiter 可选。规定字段分隔符的字符。默认是逗号 (,)。
     * @param string $enclosure 可选。规定字段环绕符的字符。默认是双引号 "。
     * @return string
     */
    public static function generateCsv($data, $delimiter = ',', $enclosure = '"') {
        $handle = fopen('php://temp', 'r+');
        foreach ($data as $line) {
            fputcsv($handle, $line, $delimiter, $enclosure);
        }
        rewind($handle);
        $contents = '';
        while (!feof($handle)) {
            $contents .= fread($handle, 8192);
        }
        fclose($handle);
        return $contents;
    }

}