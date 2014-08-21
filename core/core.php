<?php
/**
 * 框架初始化文件.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 */

class APP {
	public static $serverTime;
	
	/**
	 * 获取时间基准
	 */
	public static function getServerTime(){
		if( is_null(self::$serverTime) ) self::$serverTime=time();
		return self::$serverTime;
	}
	
	/**
	 * 初始化应用 ...
	 */
	public static function init() {
		APP::_initConfig();
		APP::_initIncludedFile();
        APP::_initRequestParam();
	}
	
	/**
	 * 初始化配置 只可调用一次...
	 */
	protected static function _initConfig() {
		//启用GZIP
		if (GZIP_COMPRESS && function_exists('ob_gzhandler')) {
			ob_start('ob_gzhandler');
		} else {
			ob_start();
		}
		//允许跨域房访问
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
		
		//开启Session
		session_start();

		//开启PHP调试功能
		DEBUG ? error_reporting(E_ALL & ~E_STRICT) : error_reporting(0);

		//设置时区
		date_default_timezone_set(TIMEZONE);
	}
	
	/**
	 * 初始化引入文件 ...
	 */
	protected static function _initIncludedFile() {
		//前台控制器基本类
		require_once 'controller.class.php';
		//后台控制器基本类
		require_once 'admincontroller.class.php';
		//数据模型基本类
		require_once 'dbmodel.class.php';
		require_once 'kvmodel.class.php';
		//视图基本类
		require_once 'view.class.php';
		//HTTP协议处理类
		require_once 'http.class.php';
		
		//云计算平台类库
		require_once CLOUD_PLATFORM_PATH . 'memcache.class.php';
		require_once CLOUD_PLATFORM_PATH . 'memcached.class.php';
		require_once CLOUD_PLATFORM_PATH . 'kvclient.class.php';
		require_once CLOUD_PLATFORM_PATH . 'taskqueue.class.php';
	}

    /**
     *  初始化Http请求参数...
     */
    protected static function _initRequestParam() {
        //定义详细请求路径及参数
        define('REQUEST_URI', Request::getFullPath());
        //定义客户端IP
        define('CLINET_IP', Request::getClientIP());
        //服务器名称
        define('SERVER_NAME', Request::getServerName());
        //前一跳转地址
        define('HTTP_REFERER', Request::getRefererUrl());
    }


    /**
     * 普通请求处理，不加（验证）的 ...
     */
    public static function normalRequest() {
        $params = App::_initRoute();
        @extract($params);
        //判断二级域名是否存在
        if($item != 'www' && file_exists((ITEMS_PATH . $item))){
            $controlFile = ITEMS_PATH . $item . '/' . $file . '.php';
        }else{
            $controlFile = ROOT_PATH . CONTROL_PATH . $file . '.php';
        }

        if (!file_exists($controlFile)) {
            exit("Controller File '$file.php' not exists!");
        }

        define('ITEM', $item);
        define('ITEM_DOMAIN', 'http://'.ITEM.'.'.GAME_DOMAIN_ROOT.'/');

        require_once $controlFile;
        $file = ucfirst($file);
        $object = new $file($param);
        if (!method_exists($object, $action)) {
            exit("Method '$file::$action' not exists!");
        }

        $results = $object->$action();
		print_r($results);
    }

    /**
     * 前台路由转发 ...
     */
    protected static function _initRoute() {
        $host = Request::getHost();
        $item = 'www';
        $pattern = "/^([a-z]+)\.".GAME_DOMAIN_ROOT."/";
        if(preg_match($pattern, strtolower($host), $matches)){
            $item = $matches[1];
        }
        $params = array('file'=>'index', 'action'=>'main', 'param' =>'', 'item'=>$item);
        if (preg_match("/\/([^\/]+)(\/*)([^\/]*)(\/*)(.*)/", REQUEST_URI, $matches)) {
            $params['file'] = $matches[1] ? $matches[1] : 'index';
            $params['action'] = $matches[3] ? $matches[3] : 'main';
            $params['param'] = $matches[5] ? $matches[5] : '';
        }
        //把GET部分删掉，最后在合并
        $strpos = strpos($params['param'], '?');
        if($strpos !== false){
            $params['param'] = substr($params['param'], 0, $strpos);
        }
        $param = array();
    	$params['param'] = explode('-', $params['param']);
    	if(count($params['param']) % 2 != 0){
    		array_pop($params['param']);
    	}
        foreach ($params['param'] as $k => $p){
        	if($k%2 == 0){
        		$param[$p] = $params['param'][$k+1];
        	}
        }

        $param = array_merge($param, $_GET);
        $param = array_merge($param, $_POST);
        $params['param'] = $param;

        return $params;
    }

    /**
     * 后台路由转发 ...
     */
    protected static function _initAdminRoute() {
        $params = array('entry'=>'admin.php', 'file'=>'index', 'action'=>'main', 'param' =>'');
        if (preg_match("/\/([^\/]+)(\/*)([^\/]*)(\/*)([^\/]*)(\/*)(.*)/", REQUEST_URI, $matches)) {
            $params['entry'] = $matches[1] ? $matches[1] : 'admin.php';
            $params['file'] = $matches[3] ? $matches[3] : 'index';
            $params['action'] = $matches[5] ? $matches[5] : 'main';
            $params['param'] = $matches[7] ? $matches[7] : '';
        }
        //把GET部分删掉，最后在合并
        $strpos = strpos($params['param'], '?');
        if($strpos !== false){
            $params['param'] = substr($params['param'], 0, $strpos);
        }
        $param = array();
        $params['param'] = explode('-', $params['param']);
        if(count($params['param']) % 2 != 0){
            array_pop($params['param']);
        }
        foreach ($params['param'] as $k => $p){
            if($k%2 == 0){
                $param[$p] = $params['param'][$k+1];
            }
        }

        $param = array_merge($param, $_GET);
        $param = array_merge($param, $_POST);
        $params['param'] = $param;

        return $params;
    }

	/**
	 * 后台请求处理 ...
     * www目录下，处理网页需求
	 */
    public static function adminRequest() {
        $params = App::_initAdminRoute();
        @extract($params);

        $scriptUrl = "/$entry/$file/$action";

        //判断是否登录
        if ("/admin.php/admin/login" != $scriptUrl && "/admin/admin/login" != $scriptUrl) {
            $loginInfo = Request::getSession('admin_user_login');
            if (empty($loginInfo) || empty($loginInfo['username']) || empty($loginInfo['id'])) {
                View::showAdminErrorMessage('/admin.php/admin/login', '对不起，你还没有登录！', '_top');
            }
        }

        $controlFile = ADMIN_ROOT_PATH . CONTROL_PATH . $file . '.php';
        if (!file_exists($controlFile)) {
            exit("AdminController File '$file.php' not exists!");
        }
        //调用控制器
        require_once $controlFile;
        $object = new $file($param);
        if (!method_exists($object, $action)) {
            exit("Method '$file::$action' not exists!");
        }

        $object->$action();
    }
}

?>