<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Add Item Manual Menu</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>itemdocmenu/add/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Menu Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="in_out" class="col-sm-2 control-label" for="input01">Item Name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="item" placeholder="Item Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="in_out" class="col-sm-2 control-label" for="input01">in or out: </label>
                        <div class="col-sm-10">
                            <select name="in_out" onchange=check(this.value)>
                                <option value="1">站内</option>
                                <option value="2">站外</option>
                            </select>
                        </div>
                    </div>
                    <div id="out" style="display:none">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input01">URL: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="url" placeholder="URL">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="parent_name" class="col-sm-2 control-label" for="input01">Parent Name: </label>
                        <div class="col-sm-10">
                            <select name="pid">
                                <option value="0" selected="selected">=顶级分类=</option>
                                <?php foreach($blogMenuList as $m){?>
                                <option value="<?php echo $m['id'];?>"><?php echo $m['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Manual Menu</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script language=javascript>
function check(in_out)
{
    var out = document.getElementById("out");
    if(in_out==1){
        out.style.display="none";
    }
    if(in_out==2){
        out.style.display="block";
    }
}
</script>
<?php
include 'footer.tpl.php';
?>