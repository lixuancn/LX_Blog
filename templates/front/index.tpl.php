<?php
include 'header.tpl.php';
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span8">
            <?php foreach ($articleList as $article){?>
            <div class="row-fluid">
                <div class="span12">
                    <blockquote>
                        <p class="index-title"><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                        <p>Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></p>
                        <p>Tag: <?php foreach($article['tag'] as $k=>$tag){if($k!=0){echo ' | ';}echo '<a href="'.GAME_URL.'search/main/keywords-'.$tag.'">'.$tag.'</a>';}?></p>
                    </blockquote>
                    <p><?php echo $article['description'];?></p>
                </div>
            </div>
            <div class="page-header"></div>
            <?php }?>
        </div>
        <div class="span4">
        	<div class="row-fluid">
        		<div class="span12">
        			<h3>最热门的文章</h3>
                    <?php foreach($articleHotList as $article){ ?>
                    <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
        		</div>
        	</div>
        	<div class="row-fluid">
        		<div class="span12">
					<h3>最新的评论</h3>
                    <?php foreach($commentNewList as $comment){ ?>
                    <p><a rel="nofollow" href="<?php echo $comment['website'];?>"><?php echo $comment['nickname'];?></a> On <a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $comment['aid'];?>"><?php echo $comment['content'];?></a></p>
                    <?php }?>
				</div>
        	</div>
        	<div class="row-fluid">
        		<div class="span12">
					<h3>热门Tag</h3>
                    <?php foreach($tags as $tag){ ?>
                        <p><a href="<?php echo GAME_URL?>search/main/keywords-<?php echo $tag['tag']?>"><?php echo $tag['tag'];?></a></p>
                    <?php }?>
				</div>
        	</div>
        	<div class="row-fluid">
        		<div class="span12">
					<h3>作者简介</h3>
        			<p>Lane：不是媒体，不为目的。只是，做自己的博客，写自己的故事。男，1991年生，现居住于大帝都。熟悉PHP，Mysql，Linux，设计模式以及数据结构。</p>
				</div>
        	</div>
        </div>
    </div>
</div>
<div class="blank-line"></div>
<div class="container-fluid" >
	<div class="row-fluid div-margin">
        <div class="span12"	>
            <ul class="unstyled">
            	<li class="span1">友情链接</li>
            </ul>
        </div>
    </div>
    <div class="row-fluid" >
        <div class="span12"	>
            <ul class="unstyled">
                <?php foreach($friendLinkList as $friendLink){?>
                <li class="span1" <?php if($friendLink['nofollow'] == 1){echo 'rel="nofollow"';}?>><a href="<?php echo $friendLink['url']?>"><?php echo $friendLink['name']?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>