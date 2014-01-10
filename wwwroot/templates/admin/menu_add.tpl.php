<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>添加菜单</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="admininfo">
				<legend>菜单选项</legend>
				<label for="nav_id">所属导航 : </label> 
				<select name="info[nav_id]" id="nav_id">
<?php
$info['nav_id']  = empty($info['nav_id']) ? '' : $info['nav_id'];
foreach($navs as $row) { 
	if ($row['nav_id'] == $info['nav_id']) {
		echo '<option value="'.$row['nav_id'].'" selected="selected">'.$row['nav_name'].'</option>';
	} else {
		echo '<option value="'.$row['nav_id'].'">'.$row['nav_name'].'</option>';
	}
}
?>
				</select>
				<br /><br />
				<label for="parent_id">父类菜单: </label> 
				<select name="info[parent_id]" id="parent_id">
					<option value="0">=顶级菜单=</option>
				</select>
				<br/><br/>
				<label for="menu_name">菜单名称 : </label> 
				<input name="info[menu_name]" id="menu_name" type="text"/> <span><font color="red">*</font>不能为空</span>
				<br />
				<label for="url">链接</label> 
				<input type="text" size="60" name="info[url]" value="#" id="url"/> <span><font color="red">*</font>脚本地址,如：test.php?action=add</span>
				<br />
				<label for="target">链接目标</label>
				<select name="info[target]" id="target">
					<?php echo Form::select_option($GLOBALS['user_config']['TARGET'])?>
				</select>
				<br />
				<label for="isshow">是否显示 : </label> 
				<input name="info[is_show]" id="isshow" type="radio" value="1" checked/>显示 
				<input name="info[is_show]" id="isshow" type="radio" value="0"/>隐藏
				<br />
				<label for="class">菜单样式 : </label> 
				<input name="info[class]" id="class" type="text" value=""/>
				<br />
				<label for="sort_order">排序 : </label> 
				<input name="info[sort_order]" id="sort_order" type="text" value="0"/>
				<br />


				<label for="memo">描述 : </label> 
				<textarea id="memo" name="info[memo]"></textarea>
				<br />
			</fieldset>
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="添加" /> 
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
$().ready(function() {
	$("#nav_id").change(function(){
		$("#parent_id").load('/admin.php/menu/getajaxmenu?navid='+$("#nav_id").val()+'&selectid=0');
	});
	$("#nav_id").change();

	$('fieldset > p > span > input').click(function(){
		var color = $(this).attr('checked') ? 'red' : '#000';
		
		$(this).parent().css('color', color);
		
	});

	$('fieldset > p > span > input').each(function(){
		var color = $(this).attr('checked') ? 'red' : '#000';
		
		$(this).parent().css('color', color);
	});
});
</script>
<?php
include 'footer.tpl.php';
?>
