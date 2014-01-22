<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>管理后台 - <?php echo WEB_NAME?></title>
    <meta name="keywords" content="管理后台">
    <meta name="description" content="管理后台">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="<?php echo ADMIN_CSS_DIR?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo ADMIN_CSS_DIR?>bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo ADMIN_CSS_DIR?>style.css" rel="stylesheet">

    <script src="<?php echo ADMIN_JS_DIR?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>bootstrap.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo ADMIN_IMAGE_DIR?>favicon.ico" rel="shortcut icon">
</head>

<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo GAME_URL?>" title="Lane PHP Blog">Lane</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li <?php if($actionMenuPid == 0){echo ' class="active"';}?>>
                        <a href="<?php echo ADMIN_URL?>" title="管理后台">后台首页</a>
                    </li>
                    <?php foreach($menuList as $key=>$menu){ ?>
                    <li class="dropdown <?php if($actionMenuPid == $menu['id']){echo ' active';}?>">
                        <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['name'];?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach($menu['son'] as $son){?>
                            <li><a href="<?php echo ADMIN_URL?><?php echo $son['class'];?>/<?php echo $son['action'];?>"><?php echo $son['name'];?></a></li>
                            <?php if(next($menu['son']) !== false){echo '<li class="divider"></li>';}?>
                            <?php }?>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="divider-vertical"></li>
                    <li>
                        <a href="/admin.php/admin/loginout" title="退出登录">退出登录</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="blank-line"></div>