<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
	<form id="search" action="" method="get" name="searchform">
     	用户名<input type="text" name="wheres[like_username]" value="<?php echo isset($wheres['like_username'])?$wheres['like_username']:''?>"/>
     	URL<input type="text" name="wheres[like_uri]" value="<?php echo isset($wheres['like_uri'])?$wheres['like_uri']:''?>" />
		日期<input type="text" name="logdate" value="<?php echo empty($logdate)?'':$logdate?>" id="logdate" />
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
		<h3>后台日志列表</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="60"><a href="#">ID</a></th>	
        			<th>操作名称</th>
        			<th>URI</th>
        			<th>请求串</th>
        			<th>用户</th>
        			<th>创建时间</th>
        			<th>IP</th>	
				</tr>
			</thead>
			<tbody>
<?php
if (!empty($info['data'])) {
	foreach($info['data'] as $row) {
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $row['log_id']?>" name="ids[]"/> <?php echo $row['log_id']?></td>
					<td><?php echo $row['operate']?></td>
					<td><?php echo $row['uri']?></td>
					<td><?php echo $row['query_string']?></td>
					<td><?php echo $row['username']?></td>
					<td><?php echo date('Y-m-d H:i:s', $row['ctime'])?></td>
					<td><?php echo $row['ip_address']?></td>
				</tr>
<?php
	}
}
?>
			</tbody>
			<tfoot>
    			<tr>
    				<td colspan="8" align="left">
    					<div id="options">
    						<label><input type="radio" value="/<?php echo $path?>/<?php echo $file?>/delete?type=week" name="op"/>删除一周前</label>&nbsp;
    						<label><input type="radio" value="/<?php echo $path?>/<?php echo $file?>/delete?type=month" name="op"/>删除一月前</label>&nbsp;
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
<script type="text/javascript">
$(document).ready(function() {
	$('#logdate').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
	});
});
</script>
<?php
include 'footer.tpl.php';
?>