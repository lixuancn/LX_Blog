<?php
include 'header.tpl.php';
?>
<div id="content">
    <div id="box">
        <form id="search" action="" method="get" name="searchform">
            用户OpenId:<input name="openId" id="openId" type="text"/> <span><font color="red">*</font>不能为空</span>
            <input type="submit" class="button1" value="查询" name="dosubmit"/>
        </form>
    </div>
    <br/>
	<div id="box">
		<h3>查询用户所在分组</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="100"><a href="#">ID</a></th>
					<th><a href="#">名称</a></th>
				</tr>
			</thead>
			<tbody>
<?php
if(isset($group)){
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $group['id']?>" name="ids[]"/> <?php echo $group['id']?></td>
                    <td><?php echo $group['name']?></td>
				</tr>
<?php
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
