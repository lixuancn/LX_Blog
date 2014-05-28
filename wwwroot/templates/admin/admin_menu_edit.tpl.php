<?php
include 'header.tpl.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="page-header">
                    <h3>Edit Administration Menu</h3>
                </div>
                <form class="form-horizontal" action="<?php echo ADMIN_URL?>adminmenu/edit/" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input01">name: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $editMenu['name']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="parent_name" class="col-sm-2 control-label" for="input01">Parent Name: </label>
                            <div class="col-sm-10">
                                <select name="pid">
                                    <option value="0" <?php if($editMenu['pid']==0){echo 'selected="selected"';}?>>=顶级分类=</option>
                                    <?php foreach($menuList as $m){?>
                                    <option value="<?php echo $m['id'];?>" <?php if($editMenu['pid']==$m['id']){echo 'selected="selected"';}?>><?php echo $m['name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="in_out" class="col-sm-2 control-label" for="input01">in or out: </label>
                            <div class="col-sm-10">
                                <select name="in_out" onchange=check(this.value)>
                                    <option value="1" <?php if($editMenu['pid']==1){echo 'selected="selected"';}?>>站内</option>
                                    <option value="2" <?php if($editMenu['pid']==2){echo 'selected="selected"';}?>>站外</option>
                                </select>
                            </div>
                        </div>
                        <div id="insite" style="display:balck">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input01">class: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="class" value="<?php echo $editMenu['class']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input01">action: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="action" value="<?php echo $editMenu['action']?>">
                                </div>
                            </div>
                        </div>
                        <div id="out" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input01">URL: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url" value="<?php echo $editMenu['url']?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="hidden" name="id" value="<?php echo $editMenu['id']?>">
                                <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Edit Admin Menu</button>
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
            var insite = document.getElementById("insite");
            var out = document.getElementById("out");
            if(in_out==1){
                insite.style.display="block";
                out.style.display="none";
            }
            if(in_out==2){
                insite.style.display="none";
                out.style.display="block";
            }
        }
    </script>
<?php
include 'footer.tpl.php';
?>