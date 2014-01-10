<?php
/**
 * 方法库封装类.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-7-4 
 * @version $Id: func.lib.php 1292 2013-11-05 09:26:23Z lixuan $
 */

class Func {
    /**
     * @descrpition 后台管理权限
     * @return array
     */
    public static function getUserAuths() {
        $uid = Request::getCookie('admin_uid');
        $gid = Request::getCookie('admin_gid');

        if ($gid == 1) return array();

        $adminObj = new AdminModel();
        $adminInfo = $adminObj->getAdminOne($uid);
        $isExtends = empty($adminInfo['is_extends_priv']) ? 0 : 1;

        $auths = $adminAuths = $groupAuths = array();
        $adminprivObj = new AdminprivModel();
        $adminAuths = $adminprivObj->getAdminpriv($uid);
        $auths = empty($adminAuths) ? $auths : array_merge($auths, $adminAuths);

        if ($isExtends) {
            $groupprivObj = new GroupprivModel();
            $groupAuths = $groupprivObj->getGrouppriv($gid);
            $auths = empty($groupAuths) ? $auths : array_merge($auths, $groupAuths);
        }

        return $auths;
    }

	// hash表
	public static function hashTable($u, $n = 128, $m = 16) {
		$h = sprintf("%u", crc32($u));
		$h1 = intval($h / $n);
		$h2 = $h1 % $n;
		$h3 = base_convert($h2, 10, $m);
		$h4 = sprintf("%02s", $h3);
		return $h4;
	}
	
	//生成GUID
	public static function createGuid() {
	    $uuid = strtolower(md5(uniqid(mt_rand(), true)));
	    return $uuid;
	}
	
	/**
	 * 获取分页导航 ...
	 * @param number $total 记录总数
	 * @param number $page 当前页
	 * @param number $pagesize 页容量
	 * @return string
	 */
	public static function getPageNav($total, $page, $pagesize = 20) {
		$url = Request::getFullPath();
		$url = preg_replace("/([&]*page=[0-9]*)/i", "", $url);
		
		$s = strpos($url, '?') === FALSE ? '?' : '&';
		$pages = ceil($total/$pagesize);
		$page = min($pages,$page);
		$prepg = $page-1;
		$nextpg = $page == $pages ? 0 : ($page+1);
		if($total < 1) return FALSE;
		$pagenav = "总数<b>$total</b> ";
		$pagenav .= $prepg ? "<a href='$url{$s}page=1'>第一页</a> <a href='$url{$s}page=$prepg'>上一页</a> " : "第一页  上一页 ";
		$pagenav .= $nextpg ? "<a href='$url{$s}page=$nextpg'>下一页</a> <a href='$url{$s}page=$pages'>尾页</a> " : "下一页  尾页 ";
		$pagenav .= "页码: <b><font color=red>$page</font>/$pages</b> <input type='text' name='page' id='page' size='2' onKeyDown=\"if(event.keyCode==13) {window.location='{$url}{$s}page='+this.value; return false;}\"> <input type='button' value='GO' onclick=\"window.location='{$url}{$s}page='+document.getElementById('page').value\">";
		return $pagenav;
	}
	
	public static function escapeString($value) {
		$value = strval($value);
		$value = trim($value); //删除前后空格
		$value = htmlspecialchars($value); //html转义
		
		return $value;
	}
	
	
	/**
	 * 按权重获取id
	 * @param unknown_type $weights [id => weight]
	 * @param unknown_type $base 100或1000分概率基数
	 * @return int
	 */
	public static function getWeightItem($weights, $base=100)
	{
		if(empty($weights)) return 0;
	
		$randValue = mt_rand(1, $base);		
	    $limitValue = 0;

	    foreach ($weights as $id => $weight)
	    {
	        $limitValue += $weight;
	
	        if ($randValue <= $limitValue)
	        {
	        	return $id;
	        }
	     }

     	return 0;
	}
	
	public static function madeQueueKey($kid, $time, $params='') {
		if(empty($kid) || empty($time)) {
			return false;
		}
		
		$time = intval($time%10000);
		$params = strlen(strval($params));
		
		return md5(md5($kid). md5($time) . md5($params));
	}
	
	public static function encryptQueue($str = ""){
		return md5(APP_KEY . APP_SECRET . md5(WEB_NAME) . $str);
	} 
	
	
	public static function compareMultArray($field, $data=array()) {
		if (empty($field) || empty($data) || !is_array($data)) return array();
		
		foreach($data as $row) {
			$keys[] = $row[$field];
		}
		
		array_multisort($keys, SORT_DESC, $data);

		return $data;
	}
	
	public static function getStringLength($string) {
		return (strlen($string)+mb_strlen($string,'utf-8'))/2;
	}
	
	
	/**
	 * 截取字符串，两个英文字符相当于一个汉字
	 * @param $String
	 * @param $Length
	 * @param $Append
	 */
	function sysSubStr($String,$Length = 12,$Append = false)
	{
		$len = 0;
	    if (strlen($String) <= $Length )
	    {
	        return $String;
	    }
	    else
	    {
	        $I = 0;
	        while ($len < $Length)
	        {
	            $StringTMP = substr($String,$I,1);
	            if ( ord($StringTMP) >=224 )
	            {
	                $StringTMP = substr($String,$I,3);
	                $I = $I + 3;
					$len += 2;
	            }
	            elseif( ord($StringTMP) >=192 )
	            {
	                $StringTMP = substr($String,$I,2);
	                $I = $I + 2;
					$len += 1;
	            }
	            else
	            {
	                $I = $I + 1;
					$len += 1;
	            }
	       		if($len <= $Length){
					$StringLast[] = $StringTMP;
				}
	        }
	        $StringLast = implode("",$StringLast);
	        if($Append)
	        {
	            $StringLast .= "...";
	        }
	        return $StringLast;
	    }
	}
	
	public static function madeAdminToolKey($uid, $optTime, $expiresTime, $pwd, $params='') {
		if(empty($uid) || empty($optTime) || empty($expiresTime) || empty($pwd)) {
			return false;
		}
		
		$optTime = intval($optTime%10000);
		$expiresTime = intval($expiresTime%10000);
		
		$params = strlen(strval($params));
		
		return md5(md5($uid). md5($optTime) . md5($expiresTime) . md5($pwd) . md5($params));
	}
	
	/**
	 * 计算输入时间戳计算执行时间
	 * @param int $init_time
	 * @return int 毫秒数
	 */
	public static function getRunTime($init_time)
	{
		$t = microtime(true) - $init_time;
		$t = round($t * 1000, 3);
		return $t;
	}
	
	/**
	 * 检查字符串长度(字母+数字组合  , 4-8占位符)
	 * @param string $str
	 */
	public static function checkString($str){
		if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$str)){
			if(preg_match("/^[\x{4e00}-\x{9fa5}]{2,4}+$/u",$str)){
				return true;
			}
		}elseif(preg_match("/^[A-Za-z]+$/u",$str)){
			if(preg_match("/^[A-Za-z]{4,8}+$/u",$str)){
				return true;
			}
		}elseif(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z]+$/u",$str)){
			if((strlen($str)+mb_strlen($str,'utf-8'))/2 >= 4 && (strlen($str)+mb_strlen($str,'utf-8'))/2 <= 8){
				return true;
			}
		}
		return false;
	}
	
	/*
	 * 过滤敏感字符
	 */
	public static function filterSensitiveCharacter($str){
		$arr = array('习近平','胡锦涛','江泽民','朱镕基','尉健行','周永康','毛泽东','毛主席','共产党');
		foreach($arr as $val){
			if(false !== strpos($str, $val)){
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 
	 * 中英文混排字符串长度
	 * @param $str
	 * @author Lixuan
	 */
	public static function abslength($str)
	{
	    if(empty($str)){
	        return 0;
	    }
	    $a = strlen($str);
		$b = mb_strlen($str, 'utf-8');
		return ($a+$b)/2;
	}
}

?>