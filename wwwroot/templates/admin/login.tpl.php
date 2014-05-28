<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html>
<head>
    <title>管理后台 - <?php echo WEB_NAME?></title>
    <meta name="keywords" content="管理后台">
    <meta name="description" content="管理后台">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo ADMIN_IMAGE_DIR?>favicon.ico" rel="shortcut icon">
    <!-- 引入JQuery文件 -->
    <script src="<?php echo ADMIN_JS_DIR?>jquery.min.js"></script>
    <!-- 引入BootStrap的CSS文件 -->
    <link href="<?php echo ADMIN_CSS_DIR?>bootstrap.min.css" rel="stylesheet">
    <!-- 引入BootStrap的JS文件 -->
    <script src="<?php echo ADMIN_JS_DIR?>bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo ADMIN_JS_DIR?>html5shiv.min.js"></script>
    <script src="<?php echo ADMIN_JS_DIR?>respond.min.js"></script>
    <![endif]-->
</head>
<body>



<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Lane<small>Blog</small></h1>
        <p class="text-center">
            <small>蝼蚁虽小，也有梦想</small>
        </p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <form class="form-horizontal" role="form" id="bindingForm" action="<?php echo ADMIN_URL?>admin/login" method="post">
                <fieldset>
                    <legend>Welcome to <?php echo WEB_NAME?> Administration Platform</legend>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Username：</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input01">Password：</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Login</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>