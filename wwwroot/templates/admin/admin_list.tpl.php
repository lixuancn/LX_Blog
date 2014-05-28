<?php
include 'header.tpl.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="page-header">
                    <h3>Administrator List</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="15%">ID</th>
                            <th width="55%">用户名</th>
                            <th width="30%">管  理</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($adminUserList as $user){?>
                        <tr>
                            <td><?php echo $user['id'];?></td>
                            <td><?php echo $user['username'];?></td>
                            <td><a href="<?php echo ADMIN_URL?>admin/edit/id-<?php echo $user['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>admin/delete/id-<?php echo $user['id']?>">删除</a></td>
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