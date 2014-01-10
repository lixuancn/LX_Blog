<?php
include 'header.tpl.php';
?>
<div id="content">
	<form id="listform" name="listform" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>/" method="post">
	<div id="box">
		<h3>批量修改菜单</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">菜单ID</a></th>
					<th><a href="#">排序</a></th>
					<th><a href="#">菜单标题</a></th>
					<th><a href="#">所属导航</a></th>
					<th><a href="#">父级分类</a></th>
					<th><a href="#">链接地址</a></th>
					<th><a href="#">目标位置</a></th>
					<th><a href="#">样式</a></th>
				</tr>
			</thead>
			<tbody>
<?php 
foreach($infos as $info) {
?>
				<tr>
					<td class="a-center"><?php echo $info['menu_id']?></td>
					<td><input type="text" name="infos[<?php echo $info['menu_id']?>][sort_order]" value="<?php echo $info['sort_order']?>" size="4"/></td>
					<td><input type="text" name="infos[<?php echo $info['menu_id']?>][menu_name]" value="<?php echo $info['menu_name']?>" size="20"/></td>
					<td>
						<select name="infos[<?php echo $info['menu_id']?>][nav_id]">
<?php
	foreach($navs as $row) { 
		if ($row['nav_id'] == $info['nav_id']) {
			echo '<option value="'.$row['nav_id'].'" selected="selected">'.$row['nav_name'].'</option>';
		} else {
			echo '<option value="'.$row['nav_id'].'">'.$row['nav_name'].'</option>';
		}
	}
?>
						</select>
					</td>
					<td>
						<select name="infos[<?php echo $info['menu_id']?>][parent_id]">
<?php
	foreach($parents as $row) { 
		if ($row['menu_id'] == $info['parent_id']) {
			echo '<option value="'.$row['menu_id'].'" selected="selected">'.$row['menu_name'].'</option>';
		} else {
			echo '<option value="'.$row['menu_id'].'">'.$row['menu_name'].'</option>';
		}
	}
?>
						</select>
					</td>
					<td><input type="text" name="infos[<?php echo $info['menu_id']?>][url]" value="<?php echo $info['url']?>" size="40"/></td>
					<td>
						<select name="infos[<?php echo $info['menu_id']?>][target]" id="target">
						  <?php echo Form::select_option($GLOBALS['user_config']['TARGET'], $info['target'])?>
						</select>
					</td>
					<td><input type="text" name="infos[<?php echo $info['menu_id']?>][class]" value="<?php echo $info['class']?>" size="40"/></td>
				</tr>
<?php
}
?>
			</tbody>
			<tfoot>
    			<tr>
    				<td colspan="8" align="left">
    					<input type="hidden" name="jumpurl" value="<?php echo $jumpurl?>" />
    					<button class="button" value="yes" name="dosubmit" type="submit"> 提交操作 </button>
					</td>
    			</tr>
			</tfoot>
		</table>
	</div>
	</form>
</div>
<?php
include 'footer.tpl.php';
?>
