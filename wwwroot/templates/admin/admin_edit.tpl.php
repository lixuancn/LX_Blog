<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>编辑管理员</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="admininfo">
				<legend>管理员选项</legend>
				<label for="groupid">所属用户组 : </label> 
				<select name="info[group_id]" id="groupid">
<?php
$info['group_id']  = empty($info['group_id']) ? '' : $info['group_id'];
foreach($groups as $row) { 
	$selected = "";
	if ($row['group_id'] == $info['group_id']) {
		$selected = 'selected="selected"';
	}
	echo '<option value="'.$row['group_id'].'" '.$selected.'>'.$row['group_name'].'</option>';
}
?>
				</select>
				<br /><br />
				<label for="username">管理员帐号 : </label> 
				<input name="info[username]" value="<?php echo $info['username']?>" id="username" type="text" size="20"/> <span><font color="red">*</font>可以为汉字和邮箱</span>
				<br />
				<label for="email">邮箱 : </label> 
				<input name="info[email]" value="<?php echo $info['email']?>" id="email" type="text" value="" size="40"/> <span><font color="red">*</font></span>
				<br />
				<label for="bindtid">绑定玩家ID</label> 
				<input name="info[bind_tid]" value="<?php echo $info['bind_tid']?>" id="bindtid" type="text" size="20"/> <span>必须为整数</span>
				<br />
				<label for="extend">用户组权限</label> 
				<input id="extend" type="checkbox" <?php echo empty($info['is_extends_priv'])?'':'checked="checked"'?> value="1" name="info[is_extends_priv]">继承
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
	   	if($info['is_extends_priv'] == 1) {
			$checked = (in_array($menuId, $privileges) || in_array($menuId, $groupprivs)) ? 'checked="checked"' : '';
			$disabled = (in_array($menuId, $groupprivs)) ? 'disabled="disabled"' : '';
	   	} else {
	   		$checked = (!empty($privileges) && in_array($menuId, $privileges)) ? 'checked="checked"' : '';
	   		$disabled = '';
	   	}
	   	$class = (!empty($groupprivs) && in_array($menuId, $groupprivs)) ? 'class="extendgroup"' : '';
?>
						<span style="width: 100px;float:left;"><input type="checkbox" value="<?php echo $menuId?>" name="menuids[]" <?php echo $class?> <?php echo $checked?> <?php echo $disabled?>/><?php echo $menu['menu_name']?></span>
<?php 
	}
?>
					</p>
				</fieldset>	
<?php 
}
?>	
			</fieldset>
			<div align="center">
				<input type="hidden" name="uid" value="<?php echo $uid?>" />
				<input type="hidden" name="jumpurl" value="<?php echo $jumpurl?>" />
				<input id="button1" type="submit" name="dosubmit" value="更新" /> 
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

	$("input[name='items']:checked").val().click(function(){
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