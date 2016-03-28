<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Add Blog Article</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>article/add/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">title: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="parent_name" class="col-sm-2 control-label" for="input01">Menu Name: </label>
                        <div class="col-sm-10">
                            <select name="mid">
                                <?php foreach($blogMenuList as $m){?>
                                    <option value="<?php echo $m['id'];?>"><?php echo $m['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Recommend Type: </label>
                        <div class="col-sm-10">
                            <select name="recommend_type">
                                    <option value="0">无推荐</option>
                                    <option value="<?php echo ParamConstant::PARAM_ARTICLE_RECOMMEND_TYPE_ALL_SITE;?>">全站推荐</option>
                                    <option value="<?php echo ParamConstant::PARAM_ARTICLE_RECOMMEND_TYPE_INDEX;?>">首页推荐</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-title: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_title" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-description: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_description" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-keywords: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_keywords" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">author: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" value="李轩Lane">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">description: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="description" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">tags: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tag" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Visits: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="clicks" value="<?php echo substr(time(), -3, 1);echo substr(time(), -4, 1);echo substr(time(), -2, 1);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">good-num: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="good_num" value="<?php echo substr(time(), -2, 2);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">bad-num: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bad_num" value="<?php echo substr(time(), -3, 1);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">create-time: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ctime" value="<?php echo date('Y-m-d H:i:s', time());?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">content: </label>
                        <div class="col-sm-10">
                            <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain"></script>
                            <!-- 配置文件 -->
                            <script type="text/javascript" src="<?php echo ADMIN_UEDITOR_DIR?>ueditor.config.js"></script>
                            <!-- 编辑器源码文件 -->
                            <script type="text/javascript" src="<?php echo ADMIN_UEDITOR_DIR?>ueditor.all.js"></script>
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container');
                            </script>
<!--                            <textarea class="input-xlarge" id="textarea" lows="20" rows="10" name="content"></textarea>-->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Blog Article</button>
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