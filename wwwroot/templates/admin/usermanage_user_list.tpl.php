<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>关注者列表</h3>
		<table width="100%">
			<thead>
                <tr>
                    总关注数：<?php echo $userInfoList['total'];?>。本次获取的关注数：<?php echo $userInfoList['count'];?>。
<?php if(!empty($userInfoList['next_openid'])){?><a href="/<?php echo $path?>/<?php echo $file?>/getFansList?next_openid=<?php echo $userInfoList['next_openid'];?>">点此获取下个列表</a><?php }?>
                </tr>
				<tr>
					<th width="100">OpenId</th>
                    <th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
<?php
if(isset($userInfoList['data']['openid'])){
    foreach($userInfoList['data']['openid'] as $row) {
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $row?>" name="ids[]"/> <?php echo $row?></td>
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
