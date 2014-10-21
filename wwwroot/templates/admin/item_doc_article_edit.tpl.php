<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Edit Item Manual Article</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>itemdocarticle/edit/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">title: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="<?php echo $article['title'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="parent_name" class="col-sm-2 control-label" for="input01">Menu Name: </label>
                        <div class="col-sm-10">
                            <select name="mid">
                                <?php foreach($blogMenuList as $m){?>
                                    <option value="<?php echo $m['id'];?>" <?php if($article['mid']==$m['id']){echo 'selected="selected"';}?>><?php echo $m['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Item Name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="item" value="<?php echo $article['item'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-title: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_title" value="<?php echo $article['seo_title'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-description: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_description" value="<?php echo $article['seo_description'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-keywords: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_keywords" value="<?php echo $article['seo_keywords'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">author: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" value="<?php echo $article['author'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">tags: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tag" value="<?php echo $article['tag'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Visits: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="clicks" value="<?php echo $article['clicks'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">good-num: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="good_num" value="<?php echo $article['good_num'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">bad-num: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bad_num" value="<?php echo $article['bad_num'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">create-time: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ctime" value="<?php echo date('Y-m-d H:i:s', $article['ctime']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">content: </label>
                        <div class="col-sm-10">
                            <p>代码部分写入[code][/code]</p>
                            <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain"><?php echo $article['content'];?></script>
                            <!-- 配置文件 -->
                            <script type="text/javascript" src="<?php echo ADMIN_UEDITOR_DIR?>ueditor.config.js"></script>
                            <!-- 编辑器源码文件 -->
                            <script type="text/javascript" src="<?php echo ADMIN_UEDITOR_DIR?>ueditor.all.js"></script>
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container');
                            </script>
<!--                            <textarea class="input-xlarge" id="textarea" rows="10" name="content">--><?php //echo $article['content'];?><!--</textarea>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="id" value="<?php echo $article['id']?>">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Edit Item Manual Article</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>