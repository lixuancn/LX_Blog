<?php
include 'header.tpl.php';
?>
<div id="content">
	<form id="listform" name="listform" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>/" method="post">
	<div id="box">
		<h3>批量修改用户组</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">组ID</a></th>
					<th><a href="#">组名称</a></th>
					<th><a href="#">组描述</a></th>
				</tr>
			</thead>
			<tbody>
<?php 
foreach($infos as $info) {
?>
				<tr>
					<td class="a-center"><?php echo $info['group_id']?></td>
					<td><input type="text" name="infos[<?php echo $info['group_id']?>][group_name]" value="<?php echo $info['group_name']?>" size="20"/></td>
					<td><input type="text" name="infos[<?php echo $info['group_id']?>][memo]" value="<?php echo $info['memo']?>" size="50"/></td>
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
