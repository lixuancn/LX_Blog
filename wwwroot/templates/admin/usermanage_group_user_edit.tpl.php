<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>移动用户分组</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="group">
                <label for="openId">用户OpenId : </label>
                <input name="openId" id="openId" type="text"/> <span><font color="red">*</font>不能为空</span>
                <br /><br />
                <legend>新分组</legend>
                <label for="to_groupId">要移动到哪个分组</label>
                <select name="to_groupId" id="to_groupId">
                    <?php if(!empty($groupList)){
                        foreach ($groupList as $k => $group){?>
                            <option value="<?php echo $group['id'];?>" <?php if($k == 0){echo 'selected="selected"';}?>><?php echo $group['name'];?></option>
                        <?php }
                    }?>

                </select>

				<br />
			</fieldset>
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="移动" />
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<?php
include 'footer.tpl.php';
?>