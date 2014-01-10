<?php
include 'header.tpl.php';
?>
    <div id="content">
        <div id="box">
            <h3>发送客服消息 - 文本</h3>
            <form id="form" action="/<?php echo $path?>/<?php echo $file?>/<?php echo $action?>" method="post">
                <fieldset>
                    <label for="tousername">接收方OpenId : </label>
                    <input name="tousername" id="tousername" type="text"/>
                    <br />
                    <label for="content">内容 : </label>
                    <textarea name="content" id="content"></textarea>
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