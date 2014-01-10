<?php
include 'header.tpl.php';
?>
<div id="content">
	<form id="listform" name="listform" action="/<?php echo $path?>/<?php echo $file?>/batchedit/" method="post">
	<div id="box">
		<h3>用户组列表</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">ID</a></th>
					<th><a href="#">组名称</a></th>
					<th><a href="#">组描述</a></th>
					<th><a href="#">系统标识</a></th>
					<th width="100px">管理</th>
				</tr>
			</thead>
			<tbody>
<?php 
foreach($info as $row) {
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $row['group_id']?>" name="ids[]"/> <?php echo $row['group_id']?></td>
					<td><?php echo $row['group_name']?></td>
					<td><?php echo $row['memo']?></td>
					<td><?php echo $row['is_system']?'默认':''?></td>
<?php 
	if ($row['is_system'] && $row['group_id'] == 1) {
?>
					<td><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑 | <img src="<?php echo ADMIN_IMAGE_DIR?>icons/delete.png" />删除</td>
<?php } else { ?>
					<td>
						<a href="/<?php echo $path?>/<?php echo $file?>/edit?gid=<?php echo $row['group_id']?>"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑</a> |
						<a href="/<?php echo $path?>/<?php echo $file?>/delete?gid=<?php echo $row['group_id']?>" onclick="return confirm('确认要删除[<?php echo $row['group_name']?>]吗？')"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/delete.png" />删除</a>
					</td> 			
<?php
	}
?>
				</tr>
<?php
}
?>
			</tbody>
			<tfoot>
    			<tr>
    				<td colspan="8" align="left">
    					<div id="options">
    						<label for="check_button"><input id="check_button" type="checkbox" name="check_button" /> 全选/取消</label>&nbsp;
    						<label><input type="radio" value="/<?php echo $path?>/<?php echo $file?>/batchedit" checked="checked" name="op"/>批量修改</label>&nbsp;
    						<button class="button" value="yes" name="batch_submit" type="submit"> 提交操作 </button>
						</div>
					</td>
    			</tr>
			</tfoot>
		</table>
	</div>
	</form>
</div>
<script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>common.js"></script>
<?php
include 'footer.tpl.php';
?>
