<?php
include 'header.tpl.php';
?>
<div id="content">
    <div id="box">
        <h3>已经添加的微信自定义菜单列表</h3>
        <form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
            <table width="100%">
                <thead>
                <tr>
                    <td rowspan="7"><a href="/<?php echo $path?>/<?php echo $file?>/push">将分类提交向微信服务器</a>------------<a href="/<?php echo $path?>/<?php echo $file?>/clear">清空微信服务器的所有分类</a></td>
                </tr>
                <tr>
                    <th width="100"><a href="#">ID</a></th>
                    <th>名称</th>
                    <th>类型</th>
                    <th>key/url</th>
                    <th>父类</th>
                    <th>点击后内容</th>
                    <th width="100px">管理</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($menuList)){
                    foreach($menuList as $menu) {
                        ?>
                        <tr>
                            <td class="a-center"><input type="checkbox" value="<?php echo $menu['id'];?>" name="ids[]"/> <?php echo $menu['id'];?></td>
                            <td><?php echo $menu['name'];?></td>
                            <td><?php echo $menu['type'];?></td>
                            <td><?php echo $menu['key_url'];?></td>
                            <td><?php if($menu['pid'] > 0 ){echo $menuList[$menu['id']]['name'];}else{ echo '顶级分类';}?></td>
                            <td><?php echo $menu['click_content'];?></td>
                            <td><a href="/<?php echo $path?>/<?php echo $file?>/edit?id=<?php echo $menu['id']?>"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/edit.png" />编辑</a> | <a href="/<?php echo $path?>/<?php echo $file?>/del?id=<?php echo $menu['id']?>" onclick="return confirm('确认要删除[<?php echo $menu['name']?>]吗？')"><img src="<?php echo ADMIN_IMAGE_DIR?>icons/delete.png" />删除</a></td>
                        </tr>

                    <?php
                    }
                }
                ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </form>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>
