<?php
if (!defined('ENTRY_NAME')) exit("Not Allowed to request this file!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo WEB_NAME?></title>
    <meta name="description" content="<?php echo WEB_NAME?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="<?php echo JS_DIR?>bootstrap.min.js"></script>
    <link href="<?php echo CSS_DIR?>bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo IMAGE_DIR?>favicon.ico" rel="shortcut icon">
</head>

<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-narrow">
            <a class="brand" href="/">Jekyll Bootstrap</a>
            <ul class="nav">
                <li><a href="/categories.html">Categories</a></li>
                <li><a href="/pages.html">Pages</a></li>
                <li><a href="/tags.html">Tags</a></li>
                <li><a href="/archive.html">Archive</a></li>
            </ul>
        </div>
    </div>
</div>
11