<?php
include 'header.tpl.php';
?>
<div id="content">
	<div id="box">
		<h3>修改微信自定义菜单</h3>
		<form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
			<fieldset id="menu">
                <label for="pid">上级菜单: </label>
                <select name="pid" id="pid">
                    <?php if(!empty($menuList)){
                        foreach ($menuList as $k => $menu){?>
                            <option value="0" <?php if($data['pid'] == 0){echo 'selected="selected"';}?>>=顶级菜单=</option>
                            <option value="<?php echo $menu['id'];?>" <?php if($data['pid'] == $menu['id']){echo 'selected="selected"';}?>><?php echo $menu['name'];?></option>
                        <?php }
                    }?>
                </select>
                <label for="name">修改分组名称: </label>
                <input name="name" id="name" type="text" value="<?php echo $data['name']?>"/>
				<br />
                <label for="type">类型: </label>
                <select name="type" id="type">
                            <option value="view" <?php if($data['pid'] == 'view'){echo 'selected="selected"';}?>>点击跳转</option>
                            <option value="click" <?php if($data['pid'] == 'click'){echo 'selected="selected"';}?>>点击事件</option>
                </select>
                <br />
                <label for="key_url">URL/KEY: </label>
                <input name="key_url" id="key_url" type="text" value="<?php echo $data['key_url']?>"/> <span><font color="red">点击跳转的输入跳转URL（含http://），点击事件输入唯一KEY</font></span>
                <br />
                <label for="click_content">点击事件内容: </label>
                <input name="click_content" id="click_content" type="text" value="<?php echo $data['click_content']?>"/>
                <br />
			</fieldset>
			<div align="center">
                <input name="id" id="id" type="hidden" value="<?php echo $data['id'];?>"/>
				<input id="button1" type="submit" name="dosubmit" value="添加" />
				<input id="button2" type="reset" value="重置"/>
			</div>
		</form>
	</div>
</div>
<?php
include 'footer.tpl.php';
?>
