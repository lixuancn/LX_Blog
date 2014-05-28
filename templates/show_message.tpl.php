<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($seo_title) ? $seo_title : SEO_TITLE; ?> - <?php echo WEB_NAME?></title>
    <meta name="keywords" content="<?php echo isset($seo_keywords) ? $seo_keywords : SEO_KEYWORDS;?>">
    <meta name="description" content="<?php echo isset($seo_description) ? $seo_description : SEO_DESCRIPTION;?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <!-- 引入BootStrap的CSS文件 -->
    <link rel="stylesheet" href="<?php echo CSS_DIR?>bootstrap.min.css">
    <!-- 引入BootStrap的JS文件 -->
    <script src="<?php echo JS_DIR?>bootstrap.min.js"></script>
    <!-- 引入JQuery文件 -->
    <script src="<?php echo JS_DIR?>jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo JS_DIR?>html5shiv.min.js"></script>
    <script src="<?php echo JS_DIR?>respond.min.js"></script>
    <![endif]-->


    <link href="<?php echo CSS_DIR?>style.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo IMAGE_DIR?>favicon.ico" rel="shortcut icon">
</head>
<body>
<title>提示信息</title>
<meta http-equiv="cache-control" content="no-cache" />
<div style="height:12px;"></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
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