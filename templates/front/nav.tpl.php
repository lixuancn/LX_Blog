<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo GAME_URL?>" title="Lane PHP Blog">Lane</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active">
                        <a href="<?php echo GAME_URL?>" title="李轩PHP博客">首页</a>
                    </li>
                    <li>
                        <a href="">PHP</a>
                    </li>
                    <li>
                        <a href="">Mysql</a>
                    </li>
                    <li>
                        <a href="">Linux</a>
                    </li>
                    <li>
                        <a href="">资源下载</a>
                    </li>
                    <li class="divider-vertical"></li>
                    <li>
                        <form class="form-search search" action="<?php echo GAME_URL?>search/main/" method="get">
                            <input type="text" class="input-large search-query" name="keywords" value="<?php if(isset($keywords)){echo $keywords;}?>">
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>