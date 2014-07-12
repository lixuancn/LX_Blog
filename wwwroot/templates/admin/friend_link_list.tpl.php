<?php
include 'header.tpl.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="page-header">
                    <h3>Blog Friend Link List</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="15%">名称</th>
                            <th width="15%">URL</th>
                            <th width="10%">是否不被蜘蛛跟踪</th>
                            <th width="15%">管理</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($friendLinkList as $friendLink){?>
                        <tr>
                            <td><?php echo $friendLink['id'];?></td>
                            <td><?php echo $friendLink['name'];?></td>
                            <td><?php echo $friendLink['url'];?></td>
                            <td><?php echo $friendLink['nofollow'];?></td>
                            <td><a href="<?php echo ADMIN_URL?>friendlink/edit/id-<?php echo $friendLink['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>friendlink/delete/id-<?php echo $friendLink['id']?>">删除</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
include 'footer.tpl.php';
?>