<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Add Blog Friend Link</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>friendlink/add/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Friend Link WebSite Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">URL: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url" placeholder="Friend Link URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">是否被蜘蛛跟踪: </label>
                        <div class="col-sm-10">
                            <select name="nofollow">
                                <option value="0">可跟踪</option>
                                <option value="1">不跟踪</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
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