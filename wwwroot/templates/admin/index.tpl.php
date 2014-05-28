<?php
include 'header.tpl.php';
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-header">
                <h1>Welcome to Administration Platform</h1>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th colspan="2" height="25"><h3><?=WEB_NAME?></h3></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="17%" >当前版本</td>
                    <td width="83%"><strong><?php echo LANE_BLOG_VERSION?></strong></td>
                </tr>
                <tr>
                    <td >版权声明</td>
                    <td>
                        1、本软件在非商业用途下自由开放，使用请保留版权声明；<br>
                        2、用户自由选择是否使用,在使用中出现任何问题和由此造成的一切损失作者将不承担任何责任；<br>
                        3、您可以对本系统的功能和界面提出你的宝贵意见，请猛戳下方的BUG提交地址；<br>
                    </td>
                </tr>
                <tr>
                    <td>注意事项</td>
                    <td>
                        1、本系统正处在开发和测试阶段，同时也在使用; <br>2、账号登陆后若看不到你想看到的项目，请先确认你是否有查看此项目的权限，再刷新页面，若仍看不到，请联系系统管理员; <br>
                        3、由于时间关系，本版本以实现功能为主，特效、美化、用户体验均不堪理想；<br>4、请及时下载更新包和补丁；
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th colspan="2" height="25"><h3>系统开发</h3></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="20%">开发人员</td>
                    <td width="80%"><strong>Lane</strong></td>
                </tr>
                <tr>
                    <td>BUG提交</td>
                    <td><a href="#" target="_blank">http://www.lanecn.com/blog/bug</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>