<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h3>Item Manual Article List</h3>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">分类</th>
                        <th width="20%">标题</th>
                        <th width="20%">描述</th>
                        <th width="20%">时间</th>
                        <th width="10%">项目</th>
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
                        <td><?php echo $article['item'];?></td>
                        <td><a href="<?php echo ADMIN_URL?>itemdocarticle/edit/id-<?php echo $article['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>itemdocarticle/delete/id-<?php echo $article['id']?>">删除</a></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <ul class="pagination">
                        <?php echo $pageNav;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>

<script>
$(document).ready(function(){
    //根据查询条件
    $("#condition").change(function(){
        var condition = $("#condition").val();
        //如果是根据时间查询，则显示时间输入框
        if(condition == 'time'){
            $("#condition_begin_time").css("display","inline");
            $("#condition_end_time").css("display","inline");
        //如果不是根据时间查询，则隐藏时间查询框
        }else{
            $("#condition_begin_time").css("display","none");
            $("#condition_end_time").css("display","none");
        }
    });
});
</script>