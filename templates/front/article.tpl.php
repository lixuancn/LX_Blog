<?php
include 'header.tpl.php';
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-1 col-sm-1 col-md-1">

                        <p>
                            <button type="button" class="btn btn-default btn-xs score_num" score_type="1">
                                <span class="glyphicon glyphicon-thumbs-up inline"></span>  <div class="inline" id="good_num"><?php echo $article['good_num']?></div>
                            </button>
                        </p>
                        <p>
                            <button type="button" class="btn btn-default btn-xs score_num" score_type="2">
                                <span class="glyphicon glyphicon-thumbs-up inline"></span>  <div class="inline" id="bad_num"><?php echo $article['bad_num']?></div>
                            </button>
                        </p>
                    </div>
                    <div class="col-xs-11 col-sm-11 col-md-11">
                        <h2><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></h2>
                        <p><small>Clicks: <?php echo $article['clicks'];?> Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></small></p>
                        <p>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default btn-sm" disabled="disabled">Tag</button>
                                <?php foreach($article['tag'] as $k=>$tag){ ?>
                                    <a href="<?php echo GAME_URL;?>search/main/keywords-<?php echo $tag;?>" class="btn btn-default" role="button"><?php echo $tag;?></a>
                                <?php }?>
                            </div>
                        </p>
                    </div>
                    <div class="row"></div>

<pre style="background: #ffffff">
    <?php echo $article['content'];?>
</pre>
                </div>
        	</div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style_24x24">
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_renren"></a>
                        <a class="jiathis_button_google"></a>
                        <a class="jiathis_button_douban"></a>
                        <a class="jiathis_button_fav"></a>
                        <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                        <a class="jiathis_counter_style"></a>
                    </div>
                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                    <!-- JiaThis Button END -->
                </div>
            </div>
            <div class="page-header"></div>
            <?php foreach($commentList as $comment){?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 comment_content">
                        <p>Reply: <?php echo $comment['nickname'];?> On <?php echo date('Y-m-d H:i:s', $comment['ctime']);?></p>
                        <p><?php echo $comment['content'];?></p>
                        <p class="text-right"><a href="#add_comment" class="reply_comment" cid="<?php echo $comment['id'];?>">回复</a></p>
                    </div>
                    <?php if(isset($comment['son'])){
                        foreach($comment['son'] as $son){?>
                            <div class="col-xs-offset-1 col-xs-12 col-sm-12 col-md-12 comment_content">
                                <p>Reply: <?php echo $son['nickname'];?> On <?php echo date('Y-m-d H:i:s', $son['ctime']);?></p>
                                <p><?php echo $son['content'];?></p>
                                <p class="text-right"><a href="#add_comment" class="reply_comment" cid="<?php echo $son['cid'];?>">回复</a></p>
                            </div>
                    <?php }}?>
                </div>
                <div class="page-header"></div>
            <?php }?>
            <form class="form-horizontal" role="form" id="bindingForm" action="<?php echo GAME_URL?>article/addcomment" method="post">
                <legend  id="add_comment">Add Comment</legend>
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
                        <input type="hidden" name="cid" value="0" id="cid">
                        <input type="hidden" name="aid" value="<?php echo $article['id'];?>">
                        <input type="hidden" name="mid" value="<?php echo $article['mid'];?>">
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
                    <?php foreach($articleHotList as $hotArticle){ ?>
                        <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $hotArticle['id'];?>"><?php echo $hotArticle['title'];?></a></p>
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

<!-- 通知栏 -->
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="myModalContent">
            ...
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    //点击回复之后，将表单的cid值更新
    $(".reply_comment").click(function(){
        var cid = $(this).attr('cid');
        $('#cid').attr('value', cid);
    });
    //鼠标悬停的地方改变颜色
    $(".comment_content").mouseover(function(){
        $(this).addClass('article_coment_mouseouve');
        $(this).mouseout(function(){
            $(this).removeClass('article_coment_mouseouve');
        });
    });

    //赞一个
    $(".score_num").click(function(){
        var score_type = $(this).attr('score_type');
        $.post("<?php echo GAME_URL;?>article/score/",
            {
                score: score_type,
                article_id: <?php echo $article['id'];?>
            },
            function(arr){
                //修改展示
                var dataObj = eval("("+arr+")");
                if(dataObj.status == 0){
                    if(score_type == 1){
                        var new_num = $("#good_num").html();
                        new_num ++;
                        $("#good_num").html(new_num);
                    }else if(score_type == 2){
                        var new_num = $("#bad_num").html();
                        new_num ++;
                        $("#bad_num").html(new_num);
                    }
                }else{
                    $('#myModal').modal('toggle');
                    $('#myModalContent').html(dataObj.msg);
                }

            }
        );
    });
});
</script>