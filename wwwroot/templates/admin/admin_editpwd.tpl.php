<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>修改密码</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="admininfo">
				<label for="username">管理员帐号 : </label> 
				<input name="username" value="<?php echo $info['username']?>" readonly="readonly" id="username" type="text" size="20"/> <span><font color="red">*</font>可以为汉字和邮箱</span>
				<br />
				<label for="passwd">管理密码 : </label> 
				<input name="password" id="passwd" type="password" value=""/> <span><font color="red">*</font></span>
				<br />
				<label for="repasswd">重复密码 : </label> 
				<input name="repasswd" id="repasswd" type="password" value=""/> <span><font color="red">*</font></span>
				<br />
				<label for="email">邮箱 : </label> 
				<input name="email" value="<?php echo $info['email']?>" id="email" readonly="readonly" type="text" value="" size="40"/>
				<br />
			</fieldset>
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="修改" /> 
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
$().ready(function() {
	$('fieldset > legend > span > input').click(function() {
		var check = $(this).attr('checked');
		var color = $(this).attr('checked') ? 'red' : '#000';
		$(this).parent().parent().parent().find('p > span > input').each(function() {
			$(this).attr('checked', check);
			$(this).parent().css('color', color);
		});
	});
	
	$('fieldset > fieldset > p > span > input').click(function(){
		var check = false;
		$(this).parent().parent().find('input').each(function(){
			if($(this).attr('checked')) check = true;			
		});	
	
		$(this).parent().parent().parent().find('legend span > input').eq(0).attr('checked',check);
		
		var color = $(this).attr('checked') ? 'red' : '#000';
		
		$(this).parent().css('color', color);
		
	});

	$('fieldset > fieldset > p > span > input').each(function(){
		var check = false;
		$(this).parent().parent().find('input').each(function(){
			if($(this).attr('checked')) check = true;			
		});	
		$(this).parent().parent().parent().find('legend > span > input').eq(0).attr('checked',check);
		
		var color = $(this).attr('checked') ? 'red' : '#000';
		
		$(this).parent().css('color', color);
	});

	$("#extend").click(function(){
	    if($(this).attr('checked')) {
	        $(".extendgroup").attr('disabled',true);
	        $(".extendgroup").attr('checked',true);
	        $(".extendgroup").parent().css('color', 'red');
	    } else {
	        $(".extendgroup").attr('disabled',false);
	    }
	   
	});
});
</script>
<?php
include 'footer.tpl.php';
?>