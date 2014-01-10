<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>分组列表</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="100"><a href="#">ID</a></th>
					<th><a href="#">名称</a></th>
					<th><a href="#">用户总数</a></th>
					<th width="100px">管理</th>
				</tr>
			</thead>
			<tbody>
<?php
if(isset($groups)){
    foreach($groups as $row) {
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $row['id']?>" name="ids[]"/> <?php echo $row['id']?></td>
                    <td><?php echo $row['name']?></td>
					<td><?php echo $row['count']?></td>
					<td><a href="/<?php echo $path?>/<?php echo $file?>/editGroupName?groupId=<?php echo $row['id']?>"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑</a></td>
				</tr>
<?php
    }
}
?>
			</tbody>
			<tfoot>

			</tfoot>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>common.js"></script>
<?php
include 'footer.tpl.php';
?>
