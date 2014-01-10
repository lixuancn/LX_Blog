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
		<h3>用户信息</h3>
		<table width="100%">
			<thead>
				<tr>
					<th width="100">OpenID</th>
					<th>是否关注</th>
					<th>昵称</th>
                    <th>性别</th>
                    <th>语言</th>
                    <th>城市</th>
                    <th>省份</th>
                    <th>国家</th>
                    <th>头像</th>
                    <th>关注时间</th>
				</tr>
			</thead>
			<tbody>
<?php
if(isset($userInfo)){
?>
				<tr>
					<td class="a-center"><input type="checkbox" value="<?php echo $userInfo['openid']?>" name="ids[]"/> <?php echo $userInfo['openid']?></td>
                    <td><?php echo $userInfo['subscribe']?></td>
					<td><?php echo $userInfo['nickname']?></td>
                    <td><?php echo $userInfo['sex']?></td>
                    <td><?php echo $userInfo['language']?></td>
                    <td><?php echo $userInfo['city']?></td>
                    <td><?php echo $userInfo['province']?></td>
                    <td><?php echo $userInfo['country']?></td>
                    <td><img src="<?php echo $userInfo['headimgurl']?>" width="48px" height="48px"></td>
                    <td><?php echo $userInfo['subscribe_time']?></td>
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
