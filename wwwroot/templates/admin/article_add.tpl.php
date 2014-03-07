<?php
include 'header.tpl.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="span6 offset4">
                <div class="page-header">
                    <h3>Add Blog Article</h3>
                </div>
                <form class="form-horizontal" action="<?php echo ADMIN_URL?>article/add/" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01">title: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="title" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label id="parent_name" class="control-label" for="input01">Menu Name: </label>
                            <div class="controls">
                                <select name="mid">
                                    <?php foreach($blogMenuList as $m){?>
                                        <option value="<?php echo $m['id'];?>" <?php if($article['mid']==$m['id']){echo 'selected="selected"';}?>><?php echo $m['name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-title: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_title" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-description: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_description" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-keywords: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_keywords" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">author: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="author" value="李轩Lane">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">description: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="description" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">tags: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="tag" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">clicks: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="clicks" value="<?php echo substr(time(), -3, 1);echo substr(time(), -4, 1);echo substr(time(), -2, 1);?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">good-num: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="good_num" value="<?php echo substr(time(), -2, 2);?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">bad-num: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="bad_num" value="<?php echo substr(time(), -3, 1);?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">create-time: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="ctime" value="<?php echo date('Y-m-d H:i:s', time());?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">content: </label>
                            <div class="controls">
                                代码部分写入[code][/code]
                                <textarea class="input-xlarge" id="textarea" rows="10" name="content"></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Blog Article</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php
include 'footer.tpl.php';
?>