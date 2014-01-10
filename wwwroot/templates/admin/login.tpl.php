<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo WEB_NAME?> - 后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ADMIN_CSS_DIR?>login-box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>jquery-1.5.1.min.js"></script>
</head>

<body>
<div id="content">
	<div id="login-box">
	<form id="login-form" method="post" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" name="login">
		<h2><?php echo WEB_NAME?> - 管理后台</h2>
		<br />
		<div id="login-box-name" style="margin-top:20px;">用户名:</div>
		<div id="login-box-field" style="margin-top:20px;"><input id="username" name="username" class="form-login" title="Username" value="<?php echo $username?>" size="30" /></div>
		<div id="login-box-name">密码:</div>
		<div id="login-box-field"><input id="passwd" name="passwd" type="password" class="form-login" title="passwd" value="<?php echo $passwd?>" size="30" /></div>

		<br />
		<span class="login-box-options"><input type="checkbox" name="rememberme" value="1" <?php echo empty($rememberKey)?'':'checked="checked"'?>/> Remember Me </span>
		<br />
		<br />
		<img id="login-button" src="<?php echo ADMIN_IMAGE_DIR?>login-btn.png" width="103" height="42" style="margin-left:90px;" />
		<input type="hidden" name="dosubmit" value=" 登 录 " />
	</form>
	</div>
	<div id="footer"><p style="color:#ffffff;text-align:center;">Powered by <a href="" target="_blank"><b>Lane</b></a>&nbsp;&copy;&nbsp;2014&nbsp;</p></div>
</div>
<script type="text/javascript">
$().ready(function() {
	$("#login-button").click(function(){
		if ($("#username").val() == '' ) {
			alert('请输入用户名！');
			$("#username").focus();
		} else if ($("#passwd").val() == '') {
			alert('请输入密码！');
			$("#passwd").focus();
		} else {
			var flag = window.confirm('你确定要进入<?php echo WEB_NAME?>后台吗');
			if (flag) {
				$("#login-form").submit();
			}
		}
	});
});
</script>
</body>
</html>