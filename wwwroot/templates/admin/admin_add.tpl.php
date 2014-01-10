<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>添加管理员</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="admininfo">
				<legend>管理员选项</legend>
				<label for="groupid">所属用户组 : </label> 
				<select name="info[group_id]" id="groupid">
<?php
foreach($groups as $row) { 
	echo '<option value="'.$row['group_id'].'" >'.$row['group_name'].'</option>';
}
?>
				</select>
				<br /><br />
				<label for="username">管理员帐号 : </label> 
				<input name="info[username]" id="username" type="text" size="20"/> <span><font color="red">*</font>可以为汉字和邮箱</span>
				<br />
				<label for="passwd">管理密码 : </label> 
				<input name="info[password]" id="passwd" type="password" value=""/> <span><font color="red">*</font></span>
				<br />
				<label for="repasswd">重复密码 : </label> 
				<input name="repasswd" id="repasswd" type="password" value=""/> <span><font color="red">*</font></span>
				<br />
				<label for="email">邮箱 : </label> 
				<input name="info[email]" id="email" type="text" value="" size="40"/> <span><font color="red">*</font></span>
				<br />
				<label for="bindtid">绑定玩家ID</label> 
				<input name="info[bind_tid]" id="bindtid" type="text" size="20"/> <span>必须为整数</span>
				<br />
			</fieldset>
			<fieldset id="privileges">
				<legend>管理员权限</legend>
<?php 
foreach($navs as $navId => $nav) {
?>
				<fieldset>
					<legend><span><?php echo $nav['nav_name']?> <input type="checkbox"/></span></legend>
					<p>
<?php 
	foreach($menus as $menuId => $menu) {
		if ($menu['nav_id'] != $navId) continue; 
?>
						<span style="width: 100px;float:left;"><input type="checkbox" value="<?php echo $menuId?>" name="menuids[]" /><?php echo $menu['menu_name']?></span>
<?php 
	}
?>
					</p>
				</fieldset>	
<?php 
}
?>	
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="添加" /> 
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
$().ready(function() {
	$('fieldset > legend > span > input').click(function() {
		var check = $(this).attr('checked');
		var color = $(this).attr('checked') ? 'red' : '#000';
		$(this).parent().parent().parent().find('p > span > input').each(function() {
			$(this).attr('checked', check);
			$(this).parent().css('color', color);
		});
	});
	
	$('fieldset > fieldset > p > span > input').click(function(){
		var check = false;
		$(this).parent().parent().find('input').each(function(){
			if($(this).attr('checked')) check = true;			
		});	
	
		$(this).parent().parent().parent().find('legend span > input').eq(0).attr('checked',check);
		
		var color = $(this).attr('checked') ? 'red' : '#000';
		
		$(this).parent().css('color', color);
		
	});

	$('fieldset > fieldset > p > span > input').each(function(){
		var check = false;
		$(this).parent().parent().find('input').each(function(){
			if($(this).attr('checked')) check = true;			
		});	
		$(this).parent().parent().parent().find('legend > span > input').eq(0).attr('checked',check);
		
		var color = $(this).attr('checked') ? 'red' : '#000';
		
		$(this).parent().css('color', color);
	});

	$("#extend").click(function(){
	    if($(this).attr('checked')) {
	        $(".extendgroup").attr('disabled',true);
	        $(".extendgroup").attr('checked',true);
	        $(".extendgroup").parent().css('color', 'red');
	    } else {
	        $(".extendgroup").attr('disabled',false);
	    }
	   
	});
});
</script>
<?php
include 'footer.tpl.php';
?>