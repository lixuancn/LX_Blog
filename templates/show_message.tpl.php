<?php
include 'front/header.tpl.php';
?>
<title>提示信息</title>
<meta http-equiv="cache-control" content="no-cache" />
<div style="height:12px;"></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <h3>温馨提示：</h3>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td align="center" bgcolor="#FFFFFF">
                        <br/>
                        <?php echo $msg?>
                        <br/>
                        <?php
                        if (empty($jumpurl) ||  $jumpurl=='') {
                            ?>
                        <br/>
                            <a href="<?php echo Request::getRefererUrl()?>" >[如果您的浏览器没有自动跳转，请点击这里 返回上一页]</a>
                            <script type="text/javascript">
                                setTimeout("<?php echo empty($target)?'':'parent.parent.' ?>location.href='<?php echo get_referer_url()?>'",<?php echo $ms?>);
                            </script>
                        <?php
                        }else if ($jumpurl=='goback' ){
                        ?>
                        <br/>
                            <a href="javascript:history.back();" >[如果您的浏览器没有自动跳转，请点击这里 返回上一页]</a>
                            <script type="text/javascript">
                                setTimeout("history.back();",<?php echo $ms?>);
                            </script>
                        <?php
                        } elseif ($jumpurl=="close") {
                        ?>
                        <br/>
                        <input type="button" name="close" value=" 关闭 " onclick="window.close();" />
                        <?php
                        } elseif ($jumpurl) {
                        ?>
                        <br/>
                            <a href="<?php echo $jumpurl?>">如果您的浏览器没有自动跳转，请点击这里</a>
                            <script type="text/javascript">
                                setTimeout("<?php echo empty($target)?'':'parent.parent.' ?>location.href='<?php echo $jumpurl?>';",<?php echo $ms?>);
                            </script>
                        <?
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php
include 'front/footer.tpl.php';
?>