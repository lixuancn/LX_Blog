<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html>
<head>
    <title>管理后台 - <?php echo WEB_NAME?></title>
    <meta name="keywords" content="管理后台">
    <meta name="description" content="管理后台">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo ADMIN_IMAGE_DIR?>favicon.ico" rel="shortcut icon">
    <!-- 引入JQuery文件 -->
    <script src="<?php echo ADMIN_JS_DIR?>jquery.min.js"></script>
    <!-- 引入BootStrap的CSS文件 -->
    <link href="<?php echo ADMIN_CSS_DIR?>bootstrap.min.css" rel="stylesheet">
    <!-- 引入BootStrap的JS文件 -->
    <script src="<?php echo ADMIN_JS_DIR?>bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo ADMIN_JS_DIR?>html5shiv.min.js"></script>
    <script src="<?php echo ADMIN_JS_DIR?>respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo GAME_URL?>" class="navbar-brand" target="_blank"><?php echo WEB_NAME?></a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?php echo ADMIN_URL?>" title="管理后台">后台首页</a>
                </li>
                <?php if(!empty($menuList)){
                    foreach($menuList as $key=>$menu){ ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['name'];?><b class="caret"></b></a>
                            <?php if(!empty($menu['son'])){?>
                                <ul class="dropdown-menu">
                                    <?php foreach($menu['son'] as $son){?>
                                        <li><a href="<?php echo ADMIN_URL?><?php echo $son['class'];?>/<?php echo $son['action'];?>"><?php echo $son['name'];?></a></li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                        </li>
                    <?php }
                } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo ADMIN_URL?>admin/loginout" title="退出登录">退出登录</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div style="height:20px;"></div>