<?php
include 'header.tpl.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="span6 offset6">
                <div class="page-header">
                    <h3>Edit Blog Article</h3>
                </div>
                <form class="form-horizontal" action="<?php echo ADMIN_URL?>article/edit/" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01">title: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="title" value="<?php echo $article['title'];?>">
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
                                <input type="text" class="input-large search-query" name="seo_title" value="<?php echo $article['seo_title'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-description: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_description" value="<?php echo $article['seo_description'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-keywords: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_keywords" value="<?php echo $article['seo_keywords'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">author: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="author" value="<?php echo $article['author'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">description: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="description" value="<?php echo $article['description'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">tags: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="tag" value="<?php echo $article['tag'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">clicks: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="clicks" value="<?php echo $article['clicks'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">good-num: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="good_num" value="<?php echo $article['good_num'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">bad-num: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="bad_num" value="<?php echo $article['bad_num'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">create-time: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="ctime" value="<?php echo date('Y-m-d H:i:s', $article['ctime']);?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">content: </label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="textarea" rows="10" name="content"><?php echo $article['content'];?></textarea>
                            </div>
                        </div>





                        <div class="form-actions">
                            <input type="hidden" name="id" value="<?php echo $article['id']?>">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Edit Blog Article</button>
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