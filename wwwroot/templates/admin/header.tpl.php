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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo ADMIN_IMAGE_DIR?>favicon.ico" rel="shortcut icon">
    <script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>bootstrap.js"></script>
    <script src="http://cnbootstrap.com/assets/js/jquery.js"></script>
    <script src="http://cnbootstrap.com/assets/js/bootstrap-dropdown.js"></script>
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
                    <li <?php if($actionMenuId == 0){echo ' class="active"';}?>>
                        <a href="<?php echo GAME_URL?>" title="管理后台">后台首页</a>
                    </li>
                    <?php foreach($menuList as $menu){ ?>
                    <li <?php if($actionMenuId == $menu['id']){echo ' class="active"';}?>>
                        <a href="<?php echo GAME_URL?>menu/main/mid-<?php echo $menu['id'];?>"><?php echo $menu['name'];?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <a class="brand" href="<?php echo GAME_URL?>" title="Lane PHP Blog">Lane</a>
    <div class="nav-collapse">
        <ul class="nav nav-pills">
            <li><a href="#">规则的链接</a></li>
            <li class="dropdown" id="menutest1">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#menutest1">
                    下拉项
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">动作</a></li>
                    <li><a href="#">另一个动作</a></li>
                    <li><a href="#">其他</a></li>
                    <li class="divider"></li>
                    <li><a href="#">被间隔的链接</a></li>
                </ul>
            </li>
            <li class='active'>
                <a data-toggle="dropdown" href="#menutest1">点击我看看</a>
            </li>
        </ul>
    </div>
</div>




<div class="blank-line"></div>