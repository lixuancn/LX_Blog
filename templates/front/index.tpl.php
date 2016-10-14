<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>PHP博客_PHP教程_PHP分享 - Lane Blog</title>
        <meta name="keywords" content="PHP博客,PHP教程,PHP分享">
        <meta name="description" content="欢迎来到Lane的PHP博客。这是关于PHP博客，有大量的PHP教程和分享，以及PHP资源下载。根据PHP博客作者亲身经历所做的PHP教程。">
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
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php foreach ($articleList as $article){?>
                        <p><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                        <p>Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></p>
                        <p>Visits: <?php echo $article['clicks'];?>. Like: <?php echo $article['good_num']?>. Bad: <?php echo $article['bad_num']?></p>
                        <p>Tag: <?php foreach($article['tag'] as $k=>$tag){if($k!=0){echo ' | ';}echo '<a href="'.GAME_URL.'search/main/keywords-'.$tag.'">'.$tag.'</a>';}?></p>
                        <p><?php echo $article['description'];?></p>
                    <div class="page-header"></div>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p><a href="http://weibo.com/u/1721815080?s=6uyXnP" target="_blank"><img border="0" src="http://service.t.sina.com.cn/widget/qmd/1721815080/813d76ea/1.png"/></a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>全站推荐</h3>
                    <?php foreach($articleAllSiteRecommend as $article){ ?>
                        <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>首页推荐</h3>
                    <?php foreach($articleIndexRecommend as $article){ ?>
                        <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
                </div>
            </div>
        	<div class="row">
        		<div class="col-xs-12 col-sm-12 col-md-12">
        			<h3>最热门的文章</h3>
                    <?php foreach($articleHotList as $article){ ?>
                    <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
        		</div>
        	</div>
        	<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
					<h3>最新的评论</h3>
                    <?php foreach($commentNewList as $comment){ ?>
                    <p><?php echo $comment['nickname'];?> On <a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $comment['aid'];?>"><?php echo $comment['content'];?></a></p>
                    <?php }?>
				</div>
        	</div>
        	<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
					<h3>热门Tag</h3>
                    <?php foreach($tags as $key=>$tag){ ?>
                        <ul class="list-unstyled list-inline">
                            <li class="tags<?php echo rand(1, 12);?>"><a href="<?php echo GAME_URL?>search/main/keywords-<?php echo $tag['tag']?>"><?php echo $tag['tag'];?></a>&nbsp;&nbsp;</li>
                            <?php if($key!=0 && $key%5 == 0) echo '<br>'?>
                        </ul>
                    <?php }?>
				</div>
        	</div>
        	<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
					<h3>作者简介</h3>
        			<p>洋名：Lane</p>
                    <p>真名：李轩</p>
                    <p>不是媒体，没有目的。只是，做自己的博客，写自己的故事。面对现实，忠于理想。梦想着改变世界的90后。性别男，爱好女。目前就职奇虎360。</p>
                    <p>Mail:lixuan868686@163.com</p>
				</div>
        	</div>
        </div>
    </div>
</div>
<div class="container" >
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <p>友情链接</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="list-unstyled list-inline">
                <?php foreach($friendLinkList as $friendLink){?>
                <li <?php if($friendLink['nofollow'] == 1){echo 'rel="nofollow"';}?>><a href="<?php echo $friendLink['url']?>"><?php echo $friendLink['name']?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>


<div class="container">
    <footer class="footer">
        <p class="pull-right"><a href="#" rel="nofollow">回到顶端</a></p>
    </footer>
    <div class="row">
        <div class="text-center">©2014 <a href="http://www.lanecn.com">www.lanecn.com</a> , All rights reserved. Power By <a href="http://www.lanecn.com">Li Xuan</a>.&nbsp;&nbsp;<a rel="nofollow" href="http://www.miitbeian.gov.cn/">京ICP备14005030号</a> <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5824445'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/stat.php%3Fid%3D5824445' type='text/javascript'%3E%3C/script%3E"));</script></div>
    </div>
</div>
</body>
</html>
<!-- 引入JQuery文件 -->
<script src="<?php echo JS_DIR?>jquery.min.js"></script>
<!-- 引入BootStrap的JS文件 -->
<script src="<?php echo JS_DIR?>bootstrap.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?php echo JS_DIR?>html5shiv.min.js"></script>
<script src="<?php echo JS_DIR?>respond.min.js"></script>
<![endif]-->

<link href="<?php echo CSS_DIR?>style.css" rel="stylesheet">