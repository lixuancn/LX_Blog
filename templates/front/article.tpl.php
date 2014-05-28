<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <p>Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></p>
                    <p>Clicks: <?php echo $article['clicks'];?>. Like: <?php echo $article['good_num']?>. Bad: <?php echo $article['bad_num']?></p>
                    <p>Tag: <?php foreach($article['tag'] as $k=>$tag){if($k!=0){echo ' | ';}echo '<a href="'.GAME_URL.'search/main/keywords-'.$tag.'">'.$tag.'</a>';}?></p>
<pre style="background: #ffffff">
    <?php echo $article['content'];?>
</pre>
                </div>
        	</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p>
                        <a href="<?php echo GAME_URL;?>article/score/score-1-article_id-<?php echo $article['id'];?>">点赞哦</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GAME_URL;?>article/score/score-2-article_id-<?php echo $article['id'];?>">请拍砖</a>
                    </p>
                </div>
            </div>
            <?php foreach($commentList as $comment){?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <p>Reply: <?php echo $comment['nickname'];?> On <?php echo date('Y-m-d H:i:s', $comment['ctime']);?></p>
                        <p><?php echo $comment['content'];?></p>
                    </div>
                </div>
                <div class="page-header"></div>
            <?php }?>
            <form class="form-horizontal" role="form" id="bindingForm" action="<?php echo GAME_URL?>article/addcomment/" method="post">
                <legend>Add Comment</legend>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nickname" placeholder="Nickname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input01" class="col-sm-2 control-label">Email: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input01" class="col-sm-2 control-label">Website: </label>
                    <div class="col-sm-10">
                        <input type="url" class="form-control" name="website" placeholder="Website">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input01" class="col-sm-2 control-label">Comment: </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="content"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input01" class="col-sm-2 control-label">Captcha: </label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <input type="text" class="form-control" name="captcha" placeholder="Captcha">
                            </div>
                            <img src="<?php echo GAME_URL?>extend/captcha" onclick="this.src='<?php echo GAME_URL?>extend/captcha/id-'+new Date().getTime()">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="aid" value="<?echo $article['id'];?>">
                        <input type="hidden" name="mid" value="<?echo $article['mid'];?>">
                        <button type="submit" class="btn btn-primary">提交</button>
                        <button type="reset" class="btn">取消</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>分类热门的文章</h3>
                    <?php foreach($articleHotList as $article){ ?>
                        <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>分类最新的评论</h3>
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
                        </ul>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>