<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理 - 菜单导航</title>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_DIR?>theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_DIR?>menu.css" />
<script type="text/javascript" src="<?php echo ADMIN_JS_DIR?>jquery-1.5.1.min.js"></script>
<script type="text/javascript">
$().ready(function(){
	$("#sidebar h3").click(function(){
		$(this).next("ul").toggle();          
	});
	
	//展开所有菜单
	$("li ul").show(); 
});
</script>
</head>

<body>
	<div id="container">
		<div id="sidebar">
			<ul>
<?php 
foreach($parents as $parent) {
	if ($gid !=1 && !in_array($parent['menu_id'], $auths)) continue;
?>
				<li><h3><a href="#" class="<?php echo $parent['class']?$parent['class']." icon":''?>"><?php echo $parent['menu_name']?></a></h3>
					<ul>
<?php
	foreach($menus as $menuId => $menu) {
		if (!$menu['parent_id'] || $menu['parent_id'] != $parent['menu_id'] || !$menu['is_show']) continue;
?>
						<li><a href="<?php echo $menu['url']?>" target="<?php echo $menu['target']?>" class="<?php echo $menu['class']?$parent['class']." icon":''?>"><?php echo $menu['menu_name']?></a></li>
<?php 
	}
?>					
					</ul>
				</li>
<?php 
}
?>
			</ul>       
		</div>
	</div>
</body>
</html>
