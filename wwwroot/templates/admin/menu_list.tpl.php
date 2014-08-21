<?php
include 'header.tpl.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="page-header">
                    <h3>Blog Menu List</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="15%">名称</th>
                            <th width="10%">方向</th>
                            <th width="15%">URL</th>
                            <th width="10%">SEO-TITLE</th>
                            <th width="15%">SEO-DESCRIPTION</th>
                            <th width="10%">SEO-KEYWORDS</th>
                            <th width="10%">所属项目</th>
                            <th width="15%">管理</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($blogMenuList as $m){?>
                        <tr>
                            <td><?php echo $m['id'];?></td>
                            <td><?php echo $m['name'];?></td>
                            <td><?php if($m['in_out']==1){echo '站内';}else{echo '出站';}?></td>
                            <td><?php echo $m['url'];?></td>
                            <td><?php echo $m['seo_title'];?></td>
                            <td><?php echo $m['seo_description'];?></td>
                            <td><?php echo $m['seo_keywords'];?></td>
                            <td><?php echo $m['item'];?></td>
                            <td><a href="<?php echo ADMIN_URL?>menu/edit/id-<?php echo $m['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>menu/delete/id-<?php echo $m['id']?>">删除</a></td>
                        </tr>
                        <?php foreach($m['son'] as $son){?>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $son['id'];?></td>
                                <td><?php echo $son['name'];?></td>
                                <td><?php if($son['in_out']==1){echo '站内';}else{echo '出站';}?></td>
                                <td><?php echo $son['url'];?></td>
                                <td><?php echo $son['seo_title'];?></td>
                                <td><?php echo $son['seo_description'];?></td>
                                <td><?php echo $son['seo_keywords'];?></td>
                                <td><?php echo $son['item'];?></td>
                                <td><a href="<?php echo ADMIN_URL?>menu/edit/id-<?php echo $son['id']?>">修改</a> | <a href="<?php echo ADMIN_URL?>menu/delete/id-<?php echo $son['id']?>">删除</a></td>
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