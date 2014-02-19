<?php
include 'header.tpl.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="span8 offset4">
                <div class="page-header">
                    <h3>Blog Article List</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="15%">分类</th>
                            <th width="10%">标题</th>
                            <th width="15%">描述</th>
                            <th width="10%">时间</th>
                            <th width="15%">管理</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($articleList as $article){?>
                        <tr>
                            <td><?php echo $article['id'];?></td>
                            <td><?php echo $article['mid'];?></td>
                            <td><?php echo $article['title'];?></td>
                            <td><?php echo $article['description'];?></td>
                            <td><?php echo date('Y-m-d H:i:s', $article['ctime']);?></td>
                            <td><a href="<?php echo ADMIN_URL?>article/edit/id-<?php echo $article['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>article/delete/id-<?php echo $article['id']?>">删除</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="pagination">
                            <ul>
                                <?php echo $pageNav;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'footer.tpl.php';
?>