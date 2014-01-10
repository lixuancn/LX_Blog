<?php
include 'header.tpl.php';
?>
    <div id="content">
        <div id="box">
            <h3>发送客服消息 - 音乐</h3>
            <form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
                <fieldset>
                    <label for="tousername">接收方OpenId : </label>
                    <input name="tousername" id="tousername" type="text"/>
                    <br />
                    <label for="title">标题 : </label>
                    <input name="tousername" id="tousername" type="text"/>
                    <br />
                    <label for="description">描述 : </label>
                    <textarea name="description" id="description"></textarea>
                    <br />
                    <label for="musicUrl">音乐链接 : </label>
                    <input name="musicUrl" id="musicUrl" type="text"/>
                    <br />
                    <label for="hqMusicUrl">高质量音乐链接 : </label>
                    <input name="hqMusicUrl" id="hqMusicUrl" type="text"/>WIFI环境优先使用该链接播放音乐
                    <br />
                    <label for="thumbMediaId">缩略图ID : </label>
                    <input name="thumbMediaId" id="thumbMediaId" type="text"/>通过上传多媒体文件，得到的id
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