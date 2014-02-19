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
    <link href="<?php echo CSS_DIR?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR?>bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR?>style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo IMAGE_DIR?>favicon.ico" rel="shortcut icon">
    <script type="text/javascript" src="<?php echo JS_DIR?>bootstrap.js"></script>
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
                        <a href="<?php echo GAME_URL?>" title="李轩PHP博客">首页</a>
                    </li>
                    <?php foreach($menuList as $menu){ ?>
                    <li <?php if($actionMenuId == $menu['id']){echo ' class="active"';}?>>
                        <a href="<?php echo GAME_URL?>menu/main/mid-<?php echo $menu['id'];?>"><?php echo $menu['name'];?></a>
                    </li>
                    <?php } ?>
                    <li class="divider-vertical"></li>
                    <li>
                    <form class="form-search search" action="<?php echo GAME_URL?>search/main/" method="get">
                        <input type="text" class="input-large search-query" name="keywords" value="<?php if(isset($keywords)){echo $keywords;}?>">
                        <button type="submit" class="btn btn-primary">搜索</button>
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="blank-line"></div>
<div class="logo">
    <h1>Lane<small>Blog</small></h1>
    <p>蝼蚁虽小，也有梦想</p>
</div>