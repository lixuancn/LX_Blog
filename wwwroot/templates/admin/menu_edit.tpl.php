<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Edit Blog Menu</h3>
            </div>
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>menu/edit/" method="post">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $blogMenu['name'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-title: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_title" value="<?php echo $blogMenu['seo_title'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-description: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_description" value="<?php echo $blogMenu['seo_description'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">seo-keywords: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="seo_keywords" value="<?php echo $blogMenu['seo_keywords'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="in_out" class="col-sm-2 control-label" for="input01">in or out: </label>
                        <div class="col-sm-10">
                            <select name="in_out" onchange=check(this.value)>
                                <option value="1" <?php if($blogMenu['in_out']==1){echo 'selected="selected"';}?>>站内</option>
                                <option value="2" <?php if($blogMenu['in_out']==2){echo 'selected="selected"';}?>>站外</option>
                            </select>
                        </div>
                    </div>
                    <div id="out" style="display:none">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input01">URL: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="url" value="<?php echo $blogMenu['url'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="parent_name" class="col-sm-2 control-label" for="input01">Parent Name: </label>
                        <div class="col-sm-10">
                            <select name="pid">
                                <option value="0" <?php if($blogMenu['pid']==0){echo 'selected="selected"';}?>>=顶级分类=</option>
                                <?php foreach($blogMenuList as $m){?>
                                    <option value="<?php echo $m['id'];?>" <?php if($blogMenu['pid']==$m['id']){echo 'selected="selected"';}?>><?php echo $m['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="id" value="<?php echo $blogMenu['id']?>">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Edit Blog Menu</button>
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