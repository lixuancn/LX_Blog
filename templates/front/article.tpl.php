<?php
include 'header.tpl.php';
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span8">
            <div class="row-fluid">
        		<div class="span12">
					<p class="index-title">深入理解PHP之数组(遍历顺序)</p>
        			<p>Date:&nbsp;2014-01-12 00:22:15，Power By 李轩</p>
        			<p>Tag:&nbsp;<a href="">PHP</a> | <a href="">Opcache</a> | <a href="">PHP性能</a></p>
        			<p>转自:&nbsp;<a href="http://www.laruence.com/2013/03/18/2846.html">http://www.laruence.com/2013/03/18/2846.html</a></p>
        			<p>请尊重作者的劳动成果，转载注明出处</p>
        			<p>这个是我上周末在”阿里PHP技术沙龙”临时分享的一个主题的PPT, 主要是介绍一下Zend Optimizer Plus(简称O+).</p>
        			<p>O+是由Zend公司开发的一个PHP性能提升工具, 在PHP5.5开始, 已经随着PHP的源代码一起发布了, 并且也改名为:Opcache.</p>
        		</div>
        	</div>
        
        	<form class="form-horizontal" action="<?php echo GAME_URL?>search/main/" method="post">
        	    <fieldset>
                    <legend>Reply Or Commint</legend>
                    <div class="control-group">
		                <label class="control-label" for="input01">Name OR Nickname:</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="name">
		                </div>
		            </div>
                    <div class="control-group">
		                <label class="control-label" for="input01">E-mail Address::</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="email">
		                </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="input01">Website:</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="website">
		                </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="input01">Comment:</label>
		                <div class="controls">
		                    <textarea class="input-large search-query" rows="3" name="comment"></textarea>
		                </div>
		            </div>
		            <div class="control-group">
		                <label class="control-label" for="input01">Captcha:</label>
		                <div class="controls">
		                    <input type="text" class="input-large search-query" name="captcha">
		                </div>
		            </div>
        	    <div class="form-actions">
		            <button type="submit" class="btn btn-primary">保存更改</button>
		            <button class="btn">取消</button>
		        </div>
            </form>
        </div>
        <div class="span4">
        	<div class="row-fluid">
        		<div class="span12">
        			<h3>本分类最热门的文章</h3>
        			<p>PHP文章1标题大概有20个字长度哦</p>
        			<p>文章2</p>
        			<p>文章3</p>
        			<p>文章4</p>
        			<p>文章5</p>
        		</div>
        	</div>
        	<div class="row-fluid">
        		<div class="span12">
					<h3>本分类最新的评论</h3>
        			<p>文章1</p>
        			<p>文章2</p>
        			<p>文章3</p>
        			<p>文章4</p>
        			<p>文章5</p>
				</div>
        	</div>
        	<div class="row-fluid">
        		<div class="span12">
					<h3>本分类的Tag</h3>

				</div>
        	</div>
        </div>
    </div>
    
    
</div>
<?php
include 'footer.tpl.php';
?>