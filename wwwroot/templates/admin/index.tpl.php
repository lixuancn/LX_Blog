<html>
<head>
<link href="<?php echo ADMIN_IMAGE_DIR?>/favicon/favicon.ico" rel="shortcut icon">
<title><?php echo WEB_NAME?> - 后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<frameset rows="80,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="/admin.php/frame/topframe/" noresize name="topFrame" scrolling="no">
  <frameset id="centerFrame" cols="200,*"  frameborder="no" border="0" framespacing="0">
    <frame src="/admin.php/frame/menuframe/" frameborder="no" noresize name="menuFrame" scrolling="auto">
    <frame src="/admin.php/frame/mainframe/" noresize name="mainFrame" scrolling="auto">
  </frameset>
</frameset>
<noframes>
	<body>您的浏览器不支持框架！</body>
</noframes>
</html>
