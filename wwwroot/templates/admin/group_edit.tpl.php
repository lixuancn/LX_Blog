<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>编辑用户组</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="admininfo">
				<legend>用户组选项</legend>
				<label for="groupname">用户组名称 : </label> 
				<input name="info[group_name]" id="groupname" type="text" value="<?php echo $info['group_name']?>"/> <span><font color="red">*</font>唯一</span>
				<br />
				<label for="memo">用户组描述 : </label>
				<textarea name="info[memo]" id="memo"><?php echo $info['memo']?></textarea>
				<br />
			</fieldset>
			<fieldset id="privileges">
				<legend>用户组权限</legend>
<?php 
foreach($navs as $navId => $nav) {
?>
				<fieldset>
					<legend><span><?php echo $nav['nav_name']?> <input type="checkbox"/></span></legend>
					<p>
<?php 
	foreach($menus as $menuId => $menu) {
		if ($menu['nav_id'] != $navId) continue; 
		$checked = in_array($menuId, $privileges) ? 'checked="checked"' : '';
?>
						<span style="width: 100px;float:left;"><input type="checkbox" value="<?php echo $menuId?>" name="menuids[]" <?php echo $checked?>/><?php echo $menu['menu_name']?></span>
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
				<input type="hidden" name="gid" value="<?php echo $gid?>" />
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
});
</script>
<?php
include 'footer.tpl.php';
?>