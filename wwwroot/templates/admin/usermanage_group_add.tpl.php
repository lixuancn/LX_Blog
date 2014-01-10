<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>添加分组</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="groupName">
				<label for="groupName">分组名称 : </label>
				<input name="groupName" id="groupName" type="text"/> <span><font color="red">*</font>不能为空</span>
				<br />
			</fieldset>
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="添加" /> 
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<?php
include 'footer.tpl.php';
?>