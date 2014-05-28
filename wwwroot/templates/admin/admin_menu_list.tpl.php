<?php
include 'header.tpl.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="page-header">
                    <h3>Administritor Menu List</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="15%">名称</th>
                            <th width="10%">方向</th>
                            <th width="26%">URL</th>
                            <th width="12%">类名</th>
                            <th width="12%">方法名</th>
                            <th width="15%">管  理</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($menuList as $menu){?>
                        <tr>
                            <td><?php echo $menu['id'];?></td>
                            <td><?php echo $menu['name'];?></td>
                            <td><?php if($menu['in_out']==1){echo '站内';}else{echo '出站';}?></td>
                            <td><?php echo $menu['url'];?></td>
                            <td><?php echo $menu['class'];?></td>
                            <td><?php echo $menu['action'];?></td>
                            <td><a href="<?php echo ADMIN_URL?>adminmenu/edit/id-<?php echo $menu['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>adminmenu/delete/id-<?php echo $menu['id']?>">删除</a></td>
                        </tr>
                        <?php foreach($menu['son'] as $son){?>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $son['id'];?></td>
                                <td><?php echo $son['name'];?></td>
                                <td><?php if($son['in_out']==1){echo '站内';}else{echo '出站';}?></td>
                                <td><?php echo $son['url'];?></td>
                                <td><?php echo $son['class'];?></td>
                                <td><?php echo $son['action'];?></td>
                                <td><a href="<?php echo ADMIN_URL?>adminmenu/edit/id-<?php echo $son['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>adminmenu/delete/id-<?php echo $son['id']?>">删除</a></td>
                            </tr>
                        <?php }?>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
include 'footer.tpl.php';
?>