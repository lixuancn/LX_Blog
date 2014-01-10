<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo WEB_NAME?> - 后台主页</title>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_DIR?>theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_DIR?>style.css" />
</head>

<body>
<div id="content">
	<div id="box">
	<table width="100%">
		<thead>
			<tr>
				<th width="20%"><a href="#">用户名称</a></th>
				<th width="20%"><a href="#">用户组</a></th>
				<th width="30%"><a href="#">IP地址</a></th>
				<th><a href="#">最后活动时间</a></th>
			</tr>
		</thead>
		<tbody>
			<tr> 
				<td><?php echo $username?></td>
				<td><?php echo $groupname?></td>
				<td><?php echo $loginip?></td>
				<td><?php echo $lasttime?></td>
			</tr>
		</tbody>
	</table>
	<table width="100%">
		<thead>
			<tr>
			  <th class="title" colspan="2" height="25"><a href="#"><?php echo WEB_NAME?></a></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="17%" >当前版本</td>
				<td width="83%"><strong>v1.0.0</strong></td>
			</tr>
			<tr>
				<td >版权声明</td>
				<td>
					1、本软件在非商业用途下自由开放，使用请保留版权声明；<br>
					2、用户自由选择是否使用,在使用中出现任何问题和由此造成的一切损失作者将不承担任何责任；<br>
					3、您可以对本系统的功能和界面提出你的宝贵意见，详见联系方式；<br>
				</td>
			</tr>
			<tr>
				<td>注意事项</td>
				<td>
					1、本系统正处在开发和测试阶段，同时也在使用; <br>2、账号登陆后若看不到你想看到的项目，请先确认你是否有查看此项目的权限，再刷新页面，若仍看不到，请联系系统管理员; <br>
                    3、由于时间关系，本版本以实现功能为主，特效、美化、用户体验均不堪理想；<br>4、请及时下载更新包和补丁；
				</td>
			</tr>
		</tbody>
	</table>
	<table width="100%">
		<thead>
			<tr>
				<th colspan="2" height="25"><a href="#">管理系统开发</a></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="17%">系统制作</td>
				<td width="83%"><strong>李轩Lane</strong></td>
			</tr>
		</tbody>
	</table>
	</div>
	<br/>
</div>
</body>
</html>