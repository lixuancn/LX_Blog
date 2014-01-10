<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>添加微信自定义菜单</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="menu">
                <label for="pid">上级菜单: </label>
                <select name="pid" id="pid">
                    <option value="0" selected="selected">=顶级菜单=</option>
                    <?php
                        if(!empty($menuList)){
                            foreach($menuList as $menu){?>
                                <option value="<?php echo $menu['id'];?>"><?php echo $menu['name'];?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <br />
                <label for="name">新分组名称: </label>
                <input name="name" id="name" type="text"/>
				<br />
                <label for="type">类型: </label>
                <select name="type" id="type">
                            <option value="view" selected="selected">点击跳转</option>
                            <option value="click">点击事件</option>
                </select>
                <br />
                <label for="key_url">URL/KEY: </label>
                <input name="key_url" id="key_url" type="text"/> <span><font color="red">点击跳转的输入跳转URL（含http://），点击事件输入唯一KEY</font></span>
                <br />
                <label for="click_content">点击事件内容: </label>
                <input name="click_content" id="click_content" type="text"/>
                <br />
			</fieldset>
			<div align="center">
				<input id="button1" type="submit" name="dosubmit" value="添加" />
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<?php
include 'footer.tpl.php';
?>
