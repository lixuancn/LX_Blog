<?php
/**
 * 视图类.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */

class View {
	
	public static $showData = array();
	
	function __construct() {
		
	}
	
	/**
	 * 为模版传递数据 ...
	 * @param string $key
	 * @param unknown_type $value
	 */
	public static function assign($key, $value) {
		self::$showData[$key] = $value;
	}
	
	/**
	 * 引入模版文件 ...
	 * @param string $file
	 * @param string $path
	 */
	public static function showTPL($file, $dir = TEMPLATE_PATH, $path = '') {
		error_reporting(0);
		$filename = $dir . $path . $file . '.tpl.php';
		if (!file_exists($filename)) {
			exit("Template file '$file.tpl.php' not Exists!<br/>");
		}
		$data = self::$showData;
		@extract($data);
		
		if (preg_match("/\/([^\/]+)\/([^\/]+)\/([^\/\?]+)/",REQUEST_URI,$matches)) {
			$path = $matches[1];
			$file = $matches[2];
			$action = $matches['3'];
		} 

		include_once $filename;
		exit();
	}

    /**
     * 引入前台模版 ...
     * @param string $file
     */
    public static function showFrontTpl($file) {
        if(ITEM != 'www'){
            $dir = TEMPLATE_ITEMS_PATH . ITEM . '/';
        }else{
            $dir = MOULD_PATH;
        }
        View::showTPL($file, $dir);
    }

	/**
	 * 引入后台模版 ...
	 * @param string $file
	 */
	public static function showAdminTpl($file, $dir = ADMIN_MOULD_PATH) {
		View::showTPL($file, $dir);
	}
	
	/**
	 * 返回API数据 ...
	 * @param string $data JSON序列化串
	 */
	public static function showJson($data) {
		if (empty($data['error_code'])) {
			$results = array('code' => 200, 'data' => $data);
		} else {
			$results = $data;
		}
		//php 5.3.3 增加的JSON_NUMERIC_CHECK
		echo json_encode($results,JSON_NUMERIC_CHECK);
		//echo json_encode($results);
		exit();
	}
	
	/**
	 * 显示跳转信息页 ...
	 * @param string $jumpurl 跳转URL
	 * @param string $msg 显示信息
	 * @param string $target 跳转目标 _blank _self _parent
	 */
	public static function showMessage($jumpurl, $msg, $target="") {
		$ms = 4000; //跳转间隔时间
		include_once  TEMPLATE_PATH . 'show_message.tpl.php';
		exit();
	}
	
	/**
	 * 显示错误信息页...
	 * @param string $jumpurl 跳转URL
	 * @param string $msg 显示信息
	 * @param string $target 跳转目标 _blank _self _parent
	 */
	public static function showErrorMessage($jumpurl, $msg, $target="") {
		$ms = 4000; //跳转间隔时间
		include_once  TEMPLATE_PATH . 'show_error_message.tpl.php';
		exit();
	}

    /**
     * 管理后台 - 显示跳转信息页 ...
     * @param string $jumpurl 跳转URL
     * @param string $msg 显示信息
     * @param string $target 跳转目标 _blank _self _parent
     */
    public static function showAdminMessage($jumpurl, $msg, $target="") {
        $ms = 4000; //跳转间隔时间
        include_once  ADMIN_TEMPLATE_PATH . 'show_message.tpl.php';
        exit();
    }

    /**
     * 管理后台 - 显示错误信息页...
     * @param string $jumpurl 跳转URL
     * @param string $msg 显示信息
     * @param string $target 跳转目标 _blank _self _parent
     */
    public static function showAdminErrorMessage($jumpurl, $msg, $target="") {
        $ms = 4000; //跳转间隔时间
        include_once  ADMIN_TEMPLATE_PATH . 'show_error_message.tpl.php';
        exit();
    }
	
	/**
	 * JS页面跳转 ...
	 * @param string $url
	 * @param int $timeOut
	 */
	public static function jsJump($url, $timeOut=0) {
		if ($timeOut == 0) {
			exit('<script>location.href="'.$url.'"</script>');
		} else {
			exit('<script>setTimeout("location.href=\''.$url.'\'",'.$timeOut.')</script>');
		}
	}
}
?>