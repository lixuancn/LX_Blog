<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>修改分组名</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="group">
				<label for="groupName">新分组名称 : </label>
				<input name="groupName" id="groupName" type="text" value="<?php echo $group['name'];?>"/> <span><font color="red">*</font>不能为空</span>
                <input name="groupId" id="groupId" type="hidden" value="<?php echo $group['id'];?>"/>
				<br />
			</fieldset>
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="修改" />
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<?php
include 'footer.tpl.php';
?>