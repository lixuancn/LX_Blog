<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Edit Blog Friend Link</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>friendlink/edit/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Friend Link WebSite Name" value="<?php echo $friendLink['name'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">URL: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url" placeholder="Friend Link URL" value="<?php echo $friendLink['url'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">是否被蜘蛛跟踪: </label>
                        <div class="col-sm-10">
                            <select name="nofollow">
                                <option value="0" <?php if($friendLink['nofollow'] == 0) echo 'selected=selected';?>>可跟踪</option>
                                <option value="1" <?php if($friendLink['nofollow'] == 1) echo 'selected=selected';?>>不跟踪</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" value="<?php echo $friendLink['id']?>" name="id">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Blog Friend Link</button>
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