<?php
include 'header.tpl.php';
?>
<div id="content">
	<form id="listform" name="listform" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>/" method="post">
	<div id="box">
		<h3>批量修改导航</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">ID</a></th>
					<th><a href="#">排序</a></th>
					<th><a href="#">导航标题</a></th>
					<th><a href="#">导航类型</a></th>
					<th><a href="#">链接地址</a></th>
					<th><a href="#">目标位置</a></th>
				</tr>
			</thead>
			<tbody>
<?php 
foreach($infos as $info) {
?>
				<tr>
					<td class="a-center"><?php echo $info['nav_id']?></td>
					<td><input type="text" name="infos[<?php echo $info['nav_id']?>][sort_order]" value="<?php echo $info['sort_order']?>" size="4"/></td>
					<td><input type="text" name="infos[<?php echo $info['nav_id']?>][nav_name]" value="<?php echo $info['nav_name']?>" size="20"/></td>
					<td>
						<select name="infos[<?php echo $info['nav_id']?>][nav_type]" id="nav_type">
							<?php echo Form::select_option($GLOBALS['user_config']['NAV_TYPE'], $info['nav_type'])?>
						</select>
					</td>
					<td><input type="text" name="infos[<?php echo $info['nav_id']?>][url]" value="<?php echo $info['url']?>" size="40"/></td>
					<td>
						<select name="infos[<?php echo $info['nav_id']?>][target]" id="target">
						  <?php echo Form::select_option($GLOBALS['user_config']['TARGET'], $info['target'])?>
						</select>
					</td>
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
