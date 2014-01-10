<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>编辑导航</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="admininfo">
				<legend>导航选项</legend>
				<label for="nav_type">导航类型: </label> 
				<select name="info[nav_type]" id="nav_type">
					<?php echo Form::select_option($GLOBALS['user_config']['NAV_TYPE'], $info['nav_type'])?>
				</select>
				<br /><br />
				<label for="nav_name">导航名称 : </label> 
				<input name="info[nav_name]" id="nav_name" type="text" value="<?php echo $info['nav_name']?>"/> <span><font color="red">*</font>不能为空</span>
				<br />
				<label for="url">链接</label> 
				<input type="text" size="60" name="info[url]" value="<?php echo $info['url']?>" id="url"/> <span>如 http://www.sina.com.cn</span>
				<br />
				<label for="target">链接目标</label>
				<select name="info[target]" id="target">
				  <?php echo Form::select_option($GLOBALS['user_config']['TARGET'], $info['target'])?>
				</select>
				<br />
				<label for="sort_order">排序 : </label> 
				<input name="info[sort_order]" id="list_order" type="text" value="<?php echo $info['sort_order']?>"/>
				<br />
				<label for="memo">描述 : </label> 
				<textarea id="memo" name="info[memo]"><?php echo $info['memo']?></textarea>
				<br />
			</fieldset>
			<div align="center">
				<input type="hidden" name="navid" value="<?php echo $navid?>" />
				<input type="hidden" name="jumpurl" value="<?php echo $jumpurl?>" />
				<input id="button1" type="submit" name="dosubmit" value="编辑" /> 
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<?php
include 'footer.tpl.php';
?>
