<?php
include 'header.tpl.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="span6 offset6">
                <div class="page-header">
                    <h3>Add Blog Menu</h3>
                </div>
                <form class="form-horizontal" action="<?php echo ADMIN_URL?>menu/add/" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01">name: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-title: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_title">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-description: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_description">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">seo-keywords: </label>
                            <div class="controls">
                                <input type="text" class="input-large search-query" name="seo_keywords">
                            </div>
                        </div>
                        <div class="control-group">
                            <label id="in_out" class="control-label" for="input01">in or out: </label>
                            <div class="controls">
                                <select name="in_out" onchange=check(this.value)>
                                    <option value="1">站内</option>
                                    <option value="2">站外</option>
                                </select>
                            </div>
                        </div>
                        <div id="out" style="display:none">
                            <div class="control-group">
                                <label class="control-label" for="input01">URL: </label>
                                <div class="controls">
                                    <input type="text" class="input-large search-query" name="url">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label id="parent_name" class="control-label" for="input01">Parent Name: </label>
                            <div class="controls">
                                <select name="pid">
                                    <option value="0" selected="selected">=顶级分类=</option>
                                    <?php foreach($blogMenuList as $m){?>
                                    <option value="<?php echo $m['id'];?>"><?php echo $m['name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Add Blog Menu</button>
                            <button type="reset" class="btn">Cancel</button>
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