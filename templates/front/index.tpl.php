<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php foreach ($articleList as $article){?>
                        <p><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                        <p>Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></p>
                        <p>Clicks: <?php echo $article['clicks'];?>. Like: <?php echo $article['good_num']?>. Bad: <?php echo $article['bad_num']?></p>
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
<?php
include 'footer.tpl.php';
?>