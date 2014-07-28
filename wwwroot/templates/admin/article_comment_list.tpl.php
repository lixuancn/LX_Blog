<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Article Common List</h3>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="35%">所属文章</th>
                        <th width="55%">内容</th>
                        <th width="10%">管  理</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($commentList as $comment){?>
                    <tr>
                        <td><?php echo $comment['id'];?></td>
                        <td><?php echo $comment['article_name'];?></td>
                        <td><?php echo $comment['content']?></td>
                        <td><a href="<?php echo ADMIN_URL?>article/delete_comment/id-<?php echo $comment['id']?>">删除</a></td>
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