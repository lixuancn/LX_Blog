<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($seo_title) ? $seo_title : SEO_TITLE; ?> - <?php echo WEB_NAME?></title>
    <meta name="keywords" content="<?php echo isset($seo_keywords) ? $seo_keywords : SEO_KEYWORDS;?>">
    <meta name="description" content="<?php echo isset($seo_description) ? $seo_description : SEO_DESCRIPTION;?>">
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
            <a href="<?php echo GAME_URL?>" class="navbar-brand" title="Lane PHP Blog">Lane</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li <?php if($actionMenuId == 0){echo ' class="active"';}?>>
                    <a href="<?php echo GAME_URL?>" title="李轩PHP博客">首页</a>
                </li>
                <?php foreach($menuList as $menu){ ?>
                    <li <?php if($actionMenuId == $menu['id']){echo ' class="active"';}?>>
                        <a href="<?php echo GAME_URL?>menu/main/mid-<?php echo $menu['id'];?>"><?php echo $menu['name'];?></a>
                    </li>
                <?php } ?>
                <li class="divider-vertical"></li>
            </ul>
            <form class="navbar-form navbar-left" role="form" action="<?php echo GAME_URL?>search/main/" method="get">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Search PHP</label>
                    <input type="text" class="form-control" name="keywords" placeholder="Search" value="<?php if(isset($keywords)){echo $keywords;}?>">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </nav>
    </div>
</header>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Lane<small>Blog</small></h1>
        <p class="text-center">
            <small>蝼蚁虽小，也有梦想</small>
        </p>
        <p class="text-center">
            <small><a href="http://meepops.lanecn.com/">PHP Socket服务</a>  |  <a href="http://lanewechat.lanecn.com/">PHP微信开发框架</a>  |  <a href="http://www.lanecn.com/article/main/aid-11">开源博客</a></small>
        </p>
    </div>
</div>