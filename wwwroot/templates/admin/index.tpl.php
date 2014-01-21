<?php
include 'header.tpl.php';
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span8">
            <div class="row-fluid">
                <div class="span12">
                    <blockquote>
                        <p class="index-title"><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                        <p>Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></p>
                        <p>Tag: <?php foreach($article['tag'] as $k=>$tag){if($k!=0){echo ' | ';}echo $tag;}?></p>
                    </blockquote>
                    <p><?php echo $article['content'];?></p>
                </div>
        	</div>
            <div class="blank-line"></div>
            <?php foreach($commentList as $comment){?>
                <div class="row-fluid">
                    <div class="span12">
                        <blockquote>
                            <p>Reply: <a rel="nofollow" href="<?php echo $comment['website'];?>"><?php echo $comment['nickname'];?></a> On <?php echo date('Y-m-d H:i:s', $comment['ctime']);?></p>
                        </blockquote>
                        <p><?php echo $comment['content'];?></p>
                    </div>
                </div>
            <?php }?>
            <div class="blank-line"></div>
        	<form class="form-horizontal" action="<?php echo GAME_URL?>article/addcomment/" method="post">
        	    <fieldset>
                    <legend>Add Comment</legend>
                    <div class="control-group">
		                <label class="control-label" for="input01">Name OR Nickname:</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="nickname">
		                </div>
		            </div>
                    <div class="control-group">
		                <label class="control-label" for="input01">E-mail Address::</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="email">
		                </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="input01">Website:</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="website">
		                </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="input01">Comment:</label>
		                <div class="controls">
		                    <textarea class="input-large search-query" rows="3" name="content"></textarea>
		                </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="input01">Captcha:</label>
		                <div class="controls">
		                    <input type="text" class="input-small search-query" name="captcha"><img src="<?php echo GAME_URL?>extend/captcha" onclick="this.src='<?php echo GAME_URL?>extend/captcha/id-'+new Date().getTime()">
		                </div>
		            </div>
        	    <div class="form-actions">
                    <input type="hidden" name="aid" value="<?echo $article['id'];?>">
                    <input type="hidden" name="mid" value="<?echo $article['mid'];?>">
		            <button type="submit" class="btn btn-primary">保存更改</button>
		            <button class="btn">取消</button>
		        </div>
            </form>
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