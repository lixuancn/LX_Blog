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
                        <p>Tag: <?php foreach($article['tag'] as $k=>$tag){if($k!=0){echo ' | ';}echo $tag;}?></p>
                    </blockquote>
                    <p><?php echo $article['description'];?></p>
                </div>
            </div>
            <div class="page-header"></div>
            <?php }?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="pagination">
                        <ul>
                            <li><a href="#">前一页</a></li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">后一页</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="row-fluid">
                <div class="span12">
                    <h3>分类热门的文章</h3>
                    <?php foreach($articleHotList as $article){ ?>
                        <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <h3>分类最新的评论</h3>
                    <?php foreach($commentNewList as $comment){ ?>
                        <p><a rel="nofollow" href="<?php echo $comment['website'];?>"><?php echo $comment['nickname'];?></a> On <a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $comment['aid'];?>"><?php echo $comment['content'];?></a></p>
                    <?php }?>
                </div>
            </div>
        	<div class="row-fluid">
        		<div class="span12">
					<h3>本分类的Tag</h3>
				</div>
        	</div>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>