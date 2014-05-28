<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Edit Administration</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>admin/edit/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Username: </label>
                        <div class="col-sm-10">
                            <input type="text" class="input-large search-query uneditable-input disabled" name="username" value="<?php echo $adminUser['username'];?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">password: </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Repeat Password: </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="id" value="<?php echo $adminUser['id']?>">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Admin</button>
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