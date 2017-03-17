<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <?php if(empty($articleList)){?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p class="align-center">啊哦～没有搜索到相关的内容哦。请尝试缩短关键字。目前只匹配文章标题搜索</p>
                </div>
            </div>
            <div class="page-header"></div>
            <?php }?>
            <?php foreach ($articleList as $article){?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p><a href="<?php echo GAME_URL?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <p>Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></p>
                    <p>Tag: <?php foreach($article['tag'] as $k=>$tag){if($k!=0){echo ' | ';}echo '<a href="'.GAME_URL.'search/main/keywords-'.$tag.'">'.$tag.'</a>';}?></p>
                    <p><?php echo $article['description'];?></p>
                </div>
            </div>
            <div class="page-header"></div>
            <?php }?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <ul class="pagination">
                        <?php echo $pageNav;?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>最热门的文章</h3>
                    <?php foreach($articleHotList as $article){ ?>
                        <p><a href="<?php echo GAME_URL;?>article/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></p>
                    <?php }?>
                </div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-xs-12 col-sm-12 col-md-12">-->
<!--                    <h3>最新的评论</h3>-->
<!--                    --><?php //foreach($commentNewList as $comment){ ?>
<!--                        <p>--><?php //echo $comment['nickname'];?><!-- On <a href="--><?php //echo GAME_URL;?><!--article/main/aid---><?php //echo $comment['aid'];?><!--">--><?php //echo $comment['content'];?><!--</a></p>-->
<!--                    --><?php //}?>
<!--                </div>-->
<!--            </div>-->
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