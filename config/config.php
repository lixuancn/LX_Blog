<?php
/**
 * 系统主配置文件.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:22
 * Blog http://www.lanecn.com
 */
//系统名称
define('WEB_NAME', 'Lane Blog');
define('PROJECT_NAME', 'LaneBlog');

//当前版本
define('LANE_BLOG_VERSION', 'v1.2.0');

//总开关, false为正常运营, true为停服维护中
define('SERVICE_STOP', false);

//启用调试信息，1是开启
define('DEBUG', 1);

//是否打印Mysql错误信息
define('PRINT_MYSQL_ERROR', 0);

if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '192.168.1.1'){
    //WEB服务器部署环境：开发
    define('WEB_SERVER', 'develop'); //'develop', 'online'

    //云计算开放平台：本地
    define('CLOUD_PLATFORM', 'local'); //'local', 'sae'
}else{
    //WEB服务器部署环境：线上
    define('WEB_SERVER', 'online'); //'develop', 'online'

    //云计算开放平台：新浪SAE
    define('CLOUD_PLATFORM', 'sae'); //'local', 'sae'
}

//时区设置
define('TIMEZONE', 'Etc/GMT-8'); 

//启用GIP
define('GZIP_COMPRESS', 0);

//密码干扰
define("PASSWORD_INTERFERE", "Lane"); //用于密码加密时

//Cookie、Session配置
define('COOKIE_DOMAIN', ''); //cookie 作用域
define('COOKIE_PRE', PROJECT_NAME . '_'); //cookie 前缀
define('COOKIE_PATH', '/'); //cookie 作用路径
define('SESSION_PRE', PROJECT_NAME . '_'); //session 前缀

define('SEO_TITLE', 'PHP博客_PHP教程_PHP分享'); //首页标题
define('SEO_KEYWORDS', 'PHP博客,PHP教程,PHP分享'); //首页关键词
define('SEO_DESCRIPTION', '欢迎来到Lane的PHP博客。这是关于PHP博客，有大量的PHP教程和分享，以及PHP资源下载。根据PHP博客作者亲身经历所做的PHP教程。'); //首页描述

/**
 * 前台目录设置
 */
define('WEB_ROOT', '/'); //网站根目录
define('ROOT_PATH', substr(dirname(__FILE__), 0, -6)); //网站绝对路径
define('CONFIG_PATH', ROOT_PATH . 'config/'); //配置文件路径
define('ITEMS_PATH', ROOT_PATH . 'items/');

define('APIS_PATH', ROOT_PATH . 'apis/');
define('SYSTEM_PATH', ROOT_PATH . 'core/'); //系统核心绝对路径
define('TEMPLATE_PATH', ROOT_PATH . 'templates/'); //模版目录
define('TEMPLATE_ITEMS_PATH', TEMPLATE_PATH . 'items/'); //模版目录
define('STATIC_PATH', WEB_ROOT . 'themes/'); //皮肤目录
define('CLASSES_PATH', ROOT_PATH . 'classes/'); //公用类目录

define('MODEL_PATH', CLASSES_PATH . 'model/'); //模型绝对路径
define('COMMON_PATH', CLASSES_PATH . 'common/'); //公共方法类绝对路径
define('BUSINESS_PATH', CLASSES_PATH . 'business/'); //业务逻辑类绝对路径

define('LIBRARY_PATH', SYSTEM_PATH . 'libraries/'); //标准库绝对路径
define('PLUGINS_PATH', SYSTEM_PATH . 'plugins/'); //插件目录
define('CLOUD_PLATFORM_PATH', SYSTEM_PATH . 'cloud/' . CLOUD_PLATFORM . '/'); //云计算平台类库目录

define('MOULD_PATH', TEMPLATE_PATH . 'front/'); //模板目录

define('CSS_DIR', STATIC_PATH . 'css/');
define('JS_DIR', STATIC_PATH . 'js/');
define('IMAGE_DIR', STATIC_PATH . 'img/');
define('SWF_DIR', STATIC_PATH . 'swf/');


/**
 * 后台目录设置
 */
define('ADMIN_WEB_ROOT', '/wwwroot/'); //后台网站根目录
define('ADMIN_ROOT_PATH', str_replace('//', '/', str_replace('\\', '/', substr(dirname(__FILE__), 0, -6)) . ADMIN_WEB_ROOT)); //后台网站绝对路径
define('ADMIN_CONFIG_PATH', ADMIN_ROOT_PATH . 'config/'); //后台配置文件路径

define('ADMIN_SYSTEM_PATH', ADMIN_ROOT_PATH . 'core/'); //系统核心绝对路径
define('ADMIN_TEMPLATE_PATH', ADMIN_ROOT_PATH . 'templates/'); //模版目录
define('ADMIN_STATIC_PATH', ADMIN_WEB_ROOT . 'themes/'); //皮肤目录
define('ADMIN_CLASSES_PATH', ADMIN_ROOT_PATH . 'classes/'); //公用类目录

define('ADMIN_MODEL_PATH', ADMIN_CLASSES_PATH . 'model/'); //模型绝对路径
define('ADMIN_COMMON_PATH', ADMIN_CLASSES_PATH . 'common/'); //公共方法类绝对路径
define('ADMIN_BUSINESS_PATH', ADMIN_CLASSES_PATH . 'business/'); //业务逻辑类绝对路径

define('ADMIN_LIBRARY_PATH', ADMIN_SYSTEM_PATH . 'libraries/'); //标准库绝对路径
define('ADMIN_PLUGINS_PATH', ADMIN_SYSTEM_PATH . 'plugins/'); //插件目录

define('ADMIN_MOULD_PATH', ADMIN_TEMPLATE_PATH . 'admin/'); //模板目录

define('ADMIN_CSS_DIR', ADMIN_STATIC_PATH . 'css/');
define('ADMIN_JS_DIR', ADMIN_STATIC_PATH . 'js/');
define('ADMIN_IMAGE_DIR', ADMIN_STATIC_PATH . 'img/');
define('ADMIN_SWF_DIR', ADMIN_STATIC_PATH . 'swf/');
define('ADMIN_PLUG_DIR', ADMIN_STATIC_PATH . 'plug/');
//百度UEDITOR富文本编辑器
define('ADMIN_UEDITOR_DIR', ADMIN_PLUG_DIR . 'ueditor/');

//邮箱服务
define('EMAIL_SENT_FOR_REPLY', true);
//define('EMAIL_ADDRESS', '2069414574@qq.com');
define('EMAIL_ADDRESS', 'a@b.com');
define('EMAIL_PASSWORD', '123');
//define('EMAIL_PASSWORD', '888666444');
define('EMAIL_SMTP', 'smtp.163.com"');
/**
 * 引入系统相关配置文件
 */
require_once CONFIG_PATH . WEB_SERVER . '/' . 'sys.conf.php';
require_once CONFIG_PATH . WEB_SERVER . '/' . 'cloud.conf.php';

?>
