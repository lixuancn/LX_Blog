<?php
include 'header.tpl.php';
?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span8">
                <?php if(empty($articleList)){?>
                <div class="row-fluid">
                    <div class="span12">
                        <p class="align-center">啊哦～没有搜索到相关的内容哦。请尝试缩短关键字。目前只匹配文章标题搜索</p>
                    </div>
                </div>
                <div class="page-header"></div>
                <?php }?>
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
                                <?php echo $pageNav;?>
                            </ul>
                        </div>
                    </div>
                </div>
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
                        <h3>Tag</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'footer.tpl.php';
?>