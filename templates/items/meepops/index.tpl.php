<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Socket_PHP即时通讯_PHP长链接 - MeepoPS</title>
    <meta name="keywords" content="PHP Socket,PHP即时通讯,PHP长链接">
    <meta name="description" content="MeepoPS是PHP Socket服务,纯PHP开发的PHP即时通讯框架.旨在提供高效稳定的由纯PHP开发的多进程PHP Socket服务.采用TCP长链接方式,轻松构建在线实时聊天, 即时游戏等需要PHP Socket的场景.MeepoPS是Meepo PHP Socket的缩写.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lane">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo CSS_DIR?>bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo STATIC_PATH?>items/meepops/css/grayscale.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo STATIC_PATH?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CSS_DIR?>googleapis-family-Lora-400-700-400italic-700italic.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CSS_DIR?>googleapis-family-Montserrat-400-700.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo JS_DIR?>html5shiv.min.js"></script>
        <script src="<?php echo JS_DIR?>respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">MeepoPS</span> 高效的PHP Socket服务
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">项目简介</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#download">快速开始</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#user-case">用户案例</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">MeepoPS</h1>
                        <p class="intro-text">高效的PHP Socket服务<br>快速开发长链接 即时通讯类应用 安全稳定</p>
                        <p>
                            <a class="btn btn-default" href="https://github.com/lixuancn/MeepoPS/archive/master.zip">
                                <i class="fa fa-download fa-fw"></i>
                                <span class="network-name">下载MeepoPS</span>
                            </a>
                            <a class="btn btn-default" href="<?php echo ITEM_DOMAIN?>doc/main/">
                                <i class="fa fa-book fa-fw"></i>
                                <span class="network-name">查看手册</span>
                            </a>
                            <a class="btn btn-default" target="_blank" href="https://github.com/lixuancn/MeepoPS">
                                <i class="fa fa-github fa-fw"></i>
                                <span class="network-name">Github</span>
                            </a>
                            <a class="btn btn-default" target="_blank" href="http://weibo.com/lanephp">
                                <i class="fa fa-weibo fa-fw"></i>
                                <span class="network-name">微博</span>
                            </a>
                        </p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About MeepoPS</h2>
                <p>MeepoPS全称是Meepo PHP Socket.</p>
                <p>MeepoPS是多进程, 高性能, 高可用, 高并发, 分布式的轻量级Socket服务. 安全稳定. 代码维护在GitHub, 开放源码, 永久免费</p>
                <p>MeepoPS由纯PHP构建, 代码简洁优雅. 最好的语言, 做更多的事情!</p>
                <p>即时通讯, 聊天, 实时监控, 在线游戏, 流媒体播放等广泛应用.</p>
                <p>没有复杂的代码和新生语法，原生PHP语言直接调用即可.</p>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Quick Start MeepoPS</h2>
                    <p>下载MeepoPS, 终端一键启动, 即可快速体验MeepoPS带来的高效和便捷</p>
                    <p>启动: cd MeepoPS && sudo demo-telnet.php start</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="user-case" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>User Case</h2>
                <p>使用MeepoPS的同学可发LOGO和简要描述到lixuan868686#163.com.</p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <img class="img-responsive" src="<?php echo STATIC_PATH?>items/meepops/img/user-case-360.png" alt="">
                    </li>
                    <li>
                        <img class="img-responsive" width="100px" src="<?php echo STATIC_PATH?>items/meepops/img/user-case-changba.jpg" alt="使用MeepoPS作为唱吧异步队列Worker，QPS10000+">
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy;2016
                <a href="http://meepops.lanecn.com/">MeepoPS</a>, All rights reserved. Power By
                <a href="http://meepops.lanecn.com">MeepoPS 高性能PHPSocket框架</a>.
            </p>
        </div>
        <div style="display: none">
            <a rel="nofollow" href="https://beian.miit.gov.cn">京ICP备14005030号-1</a>
            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5824445'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/stat.php%3Fid%3D5824445' type='text/javascript'%3E%3C/script%3E"));</script>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo JS_DIR?>jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo JS_DIR?>bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo JS_DIR?>jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo STATIC_PATH?>items/meepops/js/grayscale.js"></script>
</body>
</html>