<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
	<form id="search" action="" method="get" name="searchform">
		所属导航:
		<select id="nav" name="wheres[eq_nav_id]">
			<option value="">请选择导航</option>
<?php
$wheres['eq_nav_id']  = empty($wheres['eq_nav_id']) ? '' : $wheres['eq_nav_id'];
foreach($navs as $row) { 
	if ($row['nav_id'] == $wheres['eq_nav_id']) {
		echo '<option value="'.$row['nav_id'].'" selected="selected">'.$row['nav_name'].'</option>';
	} else {
		echo '<option value="'.$row['nav_id'].'">'.$row['nav_name'].'</option>';
	}
}
?>
		</select>
     	菜单名<input type="text" name="wheres[like_menu_name]" value="<?php echo isset($wheres['like_menu_name'])?$wheres['like_menu_name']:''?>"/>
     	链接地址<input type="text" name="wheres[like_url]" value="<?php echo isset($wheres['like_url'])?$wheres['like_url']:''?>" />
    	排序
        <select name="order">
            <option value="menu_id" <?php echo ('menu_id'==$order)?'selected':''?>>菜单ID</option>
            <option value="menu_name" <?php echo ('menu_name'==$order)?'selected':''?>>菜单名称</option>
            <option value="sort_order" <?php echo ('sort_order'==$order)?'selected':''?>>排序</option>
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
	<form id="listform" name="listform" action="/<?php echo $path?>/<?php echo $file?>/editorder/" method="post">
	<div id="box">
		<h3>菜单列表</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">ID</a></th>
					<th><a href="#">排序</a></th>
					<th><a href="#">菜单标题</a></th>
					<th><a href="#">所属导航</a></th>
					<th><a href="#">链接地址</a></th>
					<th><a href="#">目标位置</a></th>
					<th><a href="#">样式</a></th>
					<th width="100px">管理</th>
				</tr>
			</thead>
			<tbody>
<?php 
foreach($info['data'] as $row) {
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $row['menu_id']?>" name="ids[]"/> <?php echo $row['menu_id']?></td>
					<td><input type="text" name="orders[<?php echo $row['menu_id']?>]" value="<?php echo $row['sort_order']?>" size="4"/></td>
					<td><?php echo $row['menu_name']?></td>
					<td><?php echo $navs[$row['nav_id']]['nav_name']?></td>
					<td><?php echo $row['url']?></td>
					<td><?php echo $GLOBALS['user_config']['TARGET'][$row['target']]?></td>
					<td><?php echo $row['class']?></td>
					<td><a href="/<?php echo $path?>/<?php echo $file?>/edit?menuid=<?php echo $row['menu_id']?>"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑</a> | <a href="/<?php echo $path?>/<?php echo $file?>/delete?menuid=<?php echo $row['menu_id']?>" onclick="return confirm('确认要删除[<?php echo $row['menu_name']?>]吗？')"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/delete.png" />删除</a></td>
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
    						<label><input type="radio" checked="checked" value="/<?php echo $path?>/<?php echo $file?>/editorder" name="op"/>更新排序</label>&nbsp;
    						<label><input type="radio" value="/<?php echo $path?>/<?php echo $file?>/batchedit" name="op"/>批量修改</label>&nbsp;
    						<label><input type="radio" value="/<?php echo $path?>/<?php echo $file?>/batchdelete" name="op"/>批量删除</label>&nbsp;
    						<button class="button" value="yes" name="batch_submit" type="submit"> 提交操作 </button>
						</div>
					</td>
    			</tr>
			</tfoot>
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