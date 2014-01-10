<?php
include 'header.tpl.php';
?>
    <div id="content">
        <div id="box">
            <h3>发送客服消息 - 图文</h3>
            <form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
                <fieldset>
                    使用须知：<br>
                    1、图文消息可以发送多组，但是不能超过10组，否则腾讯微信公众平台可能无响应。<br>
                    2、每组都必须填写自己的标题，描述，图片链接，跳转链接。<br>
                    3、每组的标题都填写在下方的标题栏中，用英文逗号分割。描述，图片链接，跳转链接类似。<br>
                    4、标题，描述，图片链接，跳转链接的总数必须相同。<br>
                    <font color="red">Ps：JS会做的完美点，想phpmyadmin添加字段一样。这个版本是初期的，先实现功能。</font><br>
                </fieldset>
                <fieldset>
                    <label for="tousername">接收方OpenId : </label>
                    <input name="tousername" id="tousername" type="text"/>
                    <br />
                    <label for="title">标题（英文逗号,分割） : </label>
                    <textarea name="title" id="title"></textarea>
                    <br />
                    <label for="description">描述（英文逗号,分割） : </label>
                    <textarea name="description" id="description"></textarea>
                    <br />
                    <label for="picUrl">图片链接（英文逗号,分割） : </label>
                    <textarea name="picUrl" id="picUrl"></textarea>
                    <br />
                    <label for="url">点击图文消息跳转链接（英文逗号,分割） : </label>
                    <textarea name="url" id="url"></textarea>
                    <br />
                </fieldset>
                <div align="center">
                    <input id="button1" type="submit" name="dosubmit" value="发送" />
                    <input id="button2" type="reset" value="重置"/>
                </div>
            </form>
        </div>
    </div>
<?php
include 'footer.tpl.php';
?>