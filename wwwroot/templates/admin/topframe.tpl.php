<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo WEB_NAME?> - 管理后台</title>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_DIR?>theme.css" />

<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_DIR?>top.css" />
</head>

<body id="top-body">
	<div id="container">
    	<div id="header">
			<div id="login-info">
				欢迎您访问<?php echo WEB_NAME?>管理后台：<?php echo $username?>! <a href="/admin.php/admin/editpwd" target="_parent">修改密码</a>|<a href="/admin.php/admin/logout" target="_parent">退出</a>

			</div>
        	<div id="logo"><h2><?php echo WEB_NAME?></h2></div>
			<div id="topmenu">
				<ul>
<?php 
foreach($navs as $navId => $nav) {
?>
					<li <?php echo $class?>><a href="<?php if ($nav['url']) { echo $nav['url']; } else { ?>/admin.php/frame/menuframe?navid=<?php echo $navId?><?php }?>" target="<?php echo $nav['target']?>"><?php echo $nav['nav_name']?></a></li>
<?php
} 
?>
				</ul>
			</div>
		</div>
    </div>
<script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>jquery-1.5.1.min.js"></script>
<script language='javascript'>
$().ready(function(){
	$("ul li a").click(function(){
		var selectObj = $(".current");
		selectObj.removeClass('current');
		$(this).parent().addClass('current');
	});
});
</script>
</body>
</html>
