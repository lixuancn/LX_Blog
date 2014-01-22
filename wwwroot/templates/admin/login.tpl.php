<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($seo_title) ? $seo_title : SEO_TITLE; ?> - <?php echo WEB_NAME?></title>
    <meta name="keywords" content="<?php echo isset($seo_keywords) ? $seo_keywords : SEO_KEYWORDS;?>">
    <meta name="description" content="<?php echo isset($seo_description) ? $seo_description : SEO_DESCRIPTION;?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo CSS_DIR?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR?>bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR?>style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo IMAGE_DIR?>favicon.ico" rel="shortcut icon">
    <script type="text/javascript" src="<?php echo JS_DIR?>bootstrap.js"></script>
</head>

<body>

<div class="logo">
    <h1>Lane<small>Blog</small></h1>
    <p>蝼蚁虽小，也有梦想</p>
</div>

<div class="blank-line"></div>
<div class="container-fluid">
    <div class="row">
        <div class="span5 offset7">
            <form class="form-horizontal" action="<?php echo ADMIN_URL?>admin/login" method="post">
                <fieldset>
                    <legend>Welcome to <?php echo WEB_NAME?> Administrator Platform</legend>
                    <div class="control-group">
                        <label class="control-label" for="input01">Username</label>
                        <div class="controls">
                            <input type="text" class="input-large search-query" name="username">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="input01">Password</label>
                        <div class="controls">
                            <input type="password" class="input-large search-query" name="password">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" name="dosubmit" value="dosubmit">Login</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.tpl.php';
?>