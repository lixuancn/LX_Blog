<?php
include 'header.tpl.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="span6 offset4">
                <div class="page-header">
                    <h3>Add Administrator</h3>
                </div>
                <form class="form-horizontal" action="<?php echo ADMIN_URL?>admin/add/" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01">Username: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">password: </label>
                            <div class="controls">
                                <input type="password" class="input-large search-query" name="password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">password1: </label>
                            <div class="controls">
                                <input type="password" class="input-large search-query" name="password1">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Admin</button>
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