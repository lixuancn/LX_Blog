<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($seo_title) ? $seo_title : 'LaneWeChat'; ?> - LaneWeChat</title>
    <meta name="keywords" content="<?php echo isset($seo_keywords) ? $seo_keywords : 'LaneWeChat';?>">
    <meta name="description" content="<?php echo isset($seo_description) ? $seo_description : 'LaneWeChat';?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- 引入BootStrap的CSS文件 -->
    <link rel="stylesheet" href="<?php echo CSS_DIR?>bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo IMAGE_DIR?>favicon.ico" rel="shortcut icon">
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
            <a href="<?php echo 'http://'.ITEM.'.'.GAME_DOMAIN_ROOT?>" class="navbar-brand" title="LaneWeChat 微信PHP开发框架">LaneWeChat</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo ITEM_DOMAIN?>" title="PHP微信开发框架">微信PHP开发框架</a>
                </li>
                <li>
                    <a href="<?php echo ITEM_DOMAIN?>doc/main/">查看手册</a>
                </li>
                <li class="divider-vertical"></li>
                <li>
                    <a href="<?php echo GAME_URL?>" title="李轩PHP博客">Lane Blog</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">LaneWeChat</h1>
        <p class="text-center">
            <small>PHP微信开发框架，高效开发微信公众号应用。简洁而又轻量</small>
        </p>
        <p class="text-center">
            <a class="btn btn-primary" href="https://github.com/lixuancn/LaneWeChat" target="_blank" role="button">GitHub下载</a>
            <a class="btn btn-primary" href="<?php echo ITEM_DOMAIN?>doc/main/" target="_blank" role="button">查看手册</a>
        </p>
    </div>
</div>