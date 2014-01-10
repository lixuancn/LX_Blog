<?php
/**
 * 框架初始化文件.
 * @author: LaoYang <weiming2@staff.sina.com.cn>
 * @date: 2011-6-28 
 * @version $Id: core.php 1731 2013-12-05 10:53:56Z manling $
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
		//控制器基本类
		require_once 'controller.class.php';
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
        $controlFile = ROOT_PATH . CONTROL_PATH . $file . '.php';
        if (!file_exists($controlFile)) {
            exit("Controller File '$file.php' not exists!");
        }
        require_once $controlFile;
        $file = ucfirst($file);
        $object = new $file();
        if (!method_exists($object, $action)) {
            exit("Method '$file::$action' not exists!");
        }

        $results = $object->$action();
//		View::showJson($results);
    }

    /**
     * 前台路由转发 ...
     */
    protected static function _initRoute() {
        $params = array('path'=>'index', 'file'=>'index', 'action' => 'main');
        if (preg_match("/\/([^\/]+)\/([^\/]+)\/([^\/\?]+)/", REQUEST_URI, $matches)) {print_r($matches);
            $params['entry'] = $matches[1];
            $params['file'] = $matches[2];
            $params['action'] = $matches[3];
        } elseif(preg_match("/index\.php/", REQUEST_URI)) {echo 2;
            $params['entry'] = 'index';
            $params['file'] = 'index';
            $params['action'] = 'main';
        }
        return $params;
    }

	/**
	 * 后台请求处理 ...
     * www目录下，处理网页需求
	 */
    public static function adminRequest() {
        APP::checkAdminAuth();

        $params = App::_initAdminRoute();
        @extract($params);

        $controlFile = ADMIN_ROOT_PATH . CONTROL_PATH . $file . '.php';
        if (!file_exists($controlFile)) {
            exit("AdminController File '$file.php' not exists!");
        }
        //调用控制器
        require_once $controlFile;
        $object = new $file();
        if (!method_exists($object, $action)) {
            exit("Method '$file::$action' not exists!");
        }

        $object->$action();
    }

    /**
     * 检查管理员权限 ...
     */
    public static function checkAdminAuth() {
        $params = App::_initAdminRoute();
        @extract($params);
        $scriptUrl = "/$entry/$file/$action";

        $adminObj = new AdminModel();
        if ("/admin.php/admin/login" != $scriptUrl) {

            if (!$adminObj->isLogined()) {
                $adminObj->logout();
                View::showMessage('/admin.php/admin/login', '对不起，你还没有登录！', '_top');
            }
        }

        //检查用户权限
        $whiteList = array(
            '/admin.php/frame/index',
            '/admin.php/frame/topframe',
            '/admin.php/frame/menuframe',
            '/admin.php/frame/mainframe',
            '/admin.php/admin/login',
            '/admin.php/admin/logout',
            '/admin.php/admin/editpwd',
        );
        if (!in_array($scriptUrl, $whiteList)) {
            $menuObj = new MenuModel();
            $parentId = $menuObj->getParentId("url like '$scriptUrl%'");
            $gid = Request::getCookie('admin_gid',0);
            $auths = Func::getUserAuths();
            if(!in_array($parentId, $auths) && $gid != 1) {
                View::showErrorMessage('/admin.php/frame/index', "对不起，你没有该操作的权限！", '_top');
            }
        }

        //后台管理日志
        APP::writeAdminLog();
    }

    /**
     * 后台路由转发 ...
     */
    protected static function _initAdminRoute() {
        $params = array('path'=>'', 'file'=>'', 'action' => '');
        if (preg_match("/\/([^\/]+)\/([^\/]+)\/([^\/\?]+)/",REQUEST_URI,$matches)) {
            $params['entry'] = $matches[1];
            $params['file'] = $matches[2];
            $params['action'] = $matches[3];
        } elseif(preg_match("/admin\.php/",REQUEST_URI)) {
            $params['entry'] = 'admin';
            $params['file'] = 'frame';
            $params['action'] = 'index';
        }
        return $params;
    }

    /**
     * 记录后台日志 ...
     */
    public static function writeAdminLog() {
        $menuObj = new MenuModel();
        if (!ENABLE_ADMIN_LOG || !$tmp=$menuObj->getMenuByURI(REQUEST_URI)) {
            return true;
        }
        $uid = Request::getCookie('admin_uid');
        $adminObj = new AdminModel();
        $adminInfo = $adminObj->getAdminOne($uid);

        $info['operate'] = $tmp['menu_name'];
        $info['ip_address'] = Request::getClientIP();
        $info['uri'] = REQUEST_URI;
        $info['query_string'] = $_SERVER['QUERY_STRING'];
        $info['username'] = $adminInfo['username'];

        $logObj = new AdminlogModel();
        $logObj->addAdminLog($info);
    }

    /**
     * cron请求处理 ...
     */
    public static function cronRequest($argv) {
        //调用控制器及其方法		TODO
        if(WEB_SERVER=='develop' || WEB_SERVER=='test'){
            $file = $argv[1];
            $action = $argv[2];
        }else{
            $file = Request::getRequest('mod', 'string', 'main');
            $action = Request::getRequest('action', 'string', 'frame');
        }

        $controlFile = ROOT_PATH . CONTROL_PATH . $file . '.php';
        if (preg_match("/[^A-Za-z0-9]/", $file) || preg_match("/[^A-Za-z0-9_\-]/", $action) || !file_exists($controlFile)) {
            exit("请不要恶意尝试！！！");
        }
        require_once $controlFile;
        $object = new $file();
        if (!method_exists($object, $action)) {
            exit("Method '$file::$action' not exists!");
        }

        $object->$action();
    }

	/**
	 * 队列请求处理 ...
	 */
	public static function queueRequest() {
		//验证Gmtools调用权限
		$args = AuthCommon::checkQueueAuth();
		if ($args === false) {
			View::showJson(array('error_code'=>403,'error_msg'=>'权限验证出错'));
		}
		
		//调用控制器及其方法
		$file = Request::getRequest('mod', 'string', 'main');
		$action = Request::getRequest('action', 'string', 'frame');
		
		$controlFile = ROOT_PATH . CONTROL_PATH . strtolower($file) . '.php';
		if (!file_exists($controlFile)) {
			View::showJson(array('error_code'=>404,'error_msg'=>"Controller File '$file.php' not exists!"));
		}
		require_once $controlFile;
		
		try {
			$object = new $file();
			$msg = call_user_func_array(array(&$object, $action), $args);
		} catch(Exception $e) {
			$msg = array('error_code'=>405,'error_msg'=>"Method '$file::$action' not exists!");
		}

		View::showJson($msg);
	}
}

?>