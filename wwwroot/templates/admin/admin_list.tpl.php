<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
	<form id="search" action="" method="get" name="searchform">
		所属用户组:
		<select id="admin" name="wheres[eq_user_id]">
			<option value="">=全部用户组=</option>
<?php
$wheres['eq_group_id']  = empty($wheres['eq_group_id']) ? '' : $wheres['eq_group_id'];
foreach($groups as $row) { 
	if ($row['group_id'] == $wheres['eq_group_id']) {
		echo '<option value="'.$row['group_id'].'" selected="selected">'.$row['group_name'].'</option>';
	} else {
		echo '<option value="'.$row['group_id'].'">'.$row['group_name'].'</option>';
	}
}
?>
		</select> 
     	帐号<input type="text" name="wheres[like_username]" value="<?php echo isset($wheres['like_username'])?$wheres['like_username']:''?>"/>
    	排序
        <select name="order">
            <option value="user_id" <?php echo ('user_id'==$order)?'selected':''?>>用户ID</option>
            <option value="username" <?php echo ('username'==$order)?'selected':''?>>帐号</option>
        </select>
        <select name="sort">
            <option value="DESC" <?php echo ('DESC'==$sort)?'selected':''?>>降序</option>
            <option value="ASC" <?php echo ('ASC'==$sort)?'selected':''?>>升序</option>
        </select>
		容量
		<select name="pagesize">
			<?php echo Form::select_option($GLOBALS['user_config']['PAGESIZE'], $pagesize)?>
		</select>
		<input type="submit" class="button1" value="搜索" name="imageField"/>
	</form>
	</div>
	<br/>
	<form id="listform" name="listform" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>/" method="post">
	<div id="box">
		<h3>菜单列表</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">ID</a></th>
					<th><a href="#">帐号</a></th>
					<th><a href="#">所属组</a></th>
					<th><a href="#">Email</a></th>
					<th><a href="#">最后登录时间</a></th>
					<th><a href="#">最后登录IP</a></th>
					<th width="100px">管理</th>
				</tr>
			</thead>
			<tbody>
<?php 
foreach($info['data'] as $row) {
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $row['user_id']?>" name="ids[]"/> <?php echo $row['user_id']?></td>
					<td><?php echo $row['username']?></td>
					<td><?php echo $groups[$row['group_id']]['group_name']?></td>
					<td><?php echo $row['email']?></td>
					<td><?php echo date('Y-m-d H:i:s',$row['last_login_time'])?></td>
					<td><?php echo $row['last_login_ip']?></td>
<?php 
	if ($myuid == 1) {
?>
					<td>
						<a href="/<?php echo $path?>/<?php echo $file?>/edit?uid=<?php echo $row['user_id']?>"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑</a> |
						<a href="/<?php echo $path?>/<?php echo $file?>/delete?uid=<?php echo $row['user_id']?>" onclick="return confirm('确认要删除[<?php echo $row['menu_name']?>]吗？')"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/delete.png" />删除</a>
					</td>
<?php 
	} else {
?>
					<td><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑 | <img src="<?php echo ADMIN_IMAGE_DIR?>icons/delete.png" />删除  </td>
<?php 
	}
?>

				</tr>
<?php
}
?>
			</tbody>
		</table>
		<div id="pager">
			<?php echo $info['page_nav']?>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>common.js"></script>
<?php
include 'footer.tpl.php';
?>