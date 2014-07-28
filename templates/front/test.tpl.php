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
                <li><a href="">面膜</a></li>
                <li><a href="">唇彩</a></li>
                <li><a href="">沐浴</a></li>
                <li><a href="">补水</a></li>
                <li><a href="">洁面</a></li>
                <li><a href="">男士</a></li>
                <li class="divider-vertical"></li>
                <li>
                    <form class="form-inline" role="form" action="<?php echo GAME_URL?>search/main/" method="get">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Search PHP</label>
                            <input type="text" class="form-control" name="keywords" placeholder="Search" value="<?php if(isset($keywords)){echo $keywords;}?>">
                        </div>
                        <button type="submit" class="btn btn-primary">搜索</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="http://ec4.images-amazon.com/images/I/714TIxbMOJL._SL1500_.jpg" alt="..." style="height: 200px;">
                </div>
                <div class="item">
                    <img src="http://ec4.images-amazon.com/images/I/71K6GmVsqlL._SL1500_.jpg" alt="..." style="height: 200px;">
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="row">
                        <a href="a">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="background: #FC5D57; height:50px;">
                                <h2 style="line-height:50px; vertical-align:middle;">面    膜</h2>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <a href="b">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="background: #8D507A; height:50px;">
                                <h2 style="line-height:50px; vertical-align:middle;">唇    彩</h2>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <a href="c">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="background: #38799F; height:50px;">
                                <h2 style="line-height:50px; vertical-align:middle;">沐    浴</h2>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <a href="d">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="background: #59B7C1; height:50px;">
                                <h2 style="line-height:50px; vertical-align:middle;">补    水</h2>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <a href="e">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="background: #6ABC8F; height:50px;">
                                <h2 style="line-height:50px; vertical-align:middle;">洁    面</h2>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <a href="e">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="background: #6ABC8F; height:50px;">
                                <h2 style="line-height:50px; vertical-align:middle;">男    士</h2>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" >
                            <img class="col-xs-12 col-sm-12 col-md-12" style="height:100px;" src="http://ec4.images-amazon.com/images/I/81Fxug9YplL._SL1500_.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" >
                            <img class="col-xs-12 col-sm-12 col-md-12" style="height:100px;" src="http://ec4.images-amazon.com/images/I/71K6GmVsqlL._SL1500_.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" >
                            <img class="col-xs-12 col-sm-12 col-md-12" style="height:100px;" src="http://ec4.images-amazon.com/images/I/51LF%2BzQhAgL.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" >
                            <img class="col-xs-12 col-sm-12 col-md-12" style="height:100px;" src="http://ec4.images-amazon.com/images/I/81EpvLK3WJL._SL1500_.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" >
                            <img class="col-xs-12 col-sm-12 col-md-12" style="height:100px;" src="http://ec4.images-amazon.com/images/I/81hnxEUBozL._SL1500_.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" >
                            <img class="col-xs-12 col-sm-12 col-md-12" style="height:100px;" src="http://ec4.images-amazon.com/images/I/714TIxbMOJL._SL1500_.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container">
    <div class="row">
        <div class="text-center">©2014 <a href="http://www.lanecn.com">www.lanecn.com</a> , All rights reserved. Power By <a href="http://www.lanecn.com">Li Xuan</a>.&nbsp;&nbsp;<a rel="nofollow" href="http://www.miitbeian.gov.cn/">京ICP备14005030号</a></div>
    </div>
</div>
</body>
</html>
<!-- 引入JQuery文件 -->
<script src="<?php echo JS_DIR?>jquery.min.js"></script>
<!-- 引入BootStrap的CSS文件 -->
<link rel="stylesheet" href="<?php echo CSS_DIR?>bootstrap.min.css">
<!-- 引入BootStrap的JS文件 -->
<script src="<?php echo JS_DIR?>bootstrap.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?php echo JS_DIR?>html5shiv.min.js"></script>
<script src="<?php echo JS_DIR?>respond.min.js"></script>
<![endif]-->

<link href="<?php echo CSS_DIR?>style.css" rel="stylesheet">