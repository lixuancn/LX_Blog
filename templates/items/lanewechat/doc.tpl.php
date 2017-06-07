<?php
include 'header.tpl.php';
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>LaneWeChat使用手册</h3>
                    <?php foreach($itemMenuList as $itemMenu){ ?>
                        <p><?php echo $itemMenu['name'];?></p>
                        <?php if(!empty($itemMenu['article_list'])){?>
                        <ul>
                            <?php foreach($itemMenu['article_list'] as $itemArticle){?>
                                <li>
                                    <a href="<?php echo 'http://lanewechat.lanecn.com/doc/main/aid-'.$itemArticle['id']?>"><?php echo $itemArticle['title'];?></a>
                                </li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-1 col-sm-1 col-md-1">
                        <p>
                            <button type="button" class="btn btn-default btn-xs score_num" score_type="1">
                                <span class="glyphicon glyphicon-thumbs-up inline"></span>  <div class="inline good_num"><?php echo $article['good_num']?></div>
                            </button>
                        </p>
                        <p>
                            <button type="button" class="btn btn-default btn-xs score_num" score_type="2">
                                <span class="glyphicon glyphicon-thumbs-down inline"></span>  <div class="inline bad_num"><?php echo $article['bad_num']?></div>
                            </button>
                        </p>
                    </div>
                    <div class="col-xs-11 col-sm-11 col-md-11">
                        <h2><a href="<?php echo ITEM_DOMAIN?>doc/main/aid-<?php echo $article['id'];?>"><?php echo $article['title'];?></a></h2>
                        <p><small>Visits: <?php echo $article['clicks'];?> Date: <?php echo $article['ctime'];?> Power By <?php echo $article['author']?></small></p>
                        <p>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default btn-sm" disabled="disabled">Tag</button>
                                <?php foreach($article['tag'] as $k=>$tag){ ?>
                                    <a href="<?php echo ITEM_DOMAIN;?>search/main/keywords-<?php echo $tag;?>" class="btn btn-default" role="button"><?php echo $tag;?></a>
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
                <div class="col-xs-6 col-sm-3 col-md-3 text-center">
                    <button type="button" class="btn btn-default btn-xs score_num" score_type="1">
                        <span class="glyphicon glyphicon-chevron-up inline"></span>  <div class="inline good_num"><?php echo $article['good_num']?></div> 赞
                    </button>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 text-center">
                    <button type="button" class="btn btn-default btn-xs score_num" score_type="2">
                        <span class="glyphicon glyphicon-chevron-down inline"></span>  <div class="inline bad_num"><?php echo $article['bad_num']?></div> 嘘
                    </button>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                </div>
            </div>
            <div class="page-header"></div>
            <!-- 搜狐畅言评论框 start -->
            <!--高速版-->
            <div id="SOHUCS" sid="<?php echo $article['id']?>"></div>
            <script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
            <script type="text/javascript">
                window.changyan.api.config({
                    appid: 'cyt3ePLK2',
                    conf: 'prod_b4a8c3b1f84f9cb19e63ab1ddc2681d4'
                });
            </script>
            <!--其他参数先留着待用-->
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>

<!-- 通知栏 -->
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="myModalContent"></div>
    </div>
</div>