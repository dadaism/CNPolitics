<div class="post-sidebar">
	<div class="post-filter-box">
		<div class="filter-header">
			<img class="expand-topic-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-topic-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			按<a href="">专题</a>筛选
		</div>
	<div class="topic-filter">
		<ul>
<?php
	global $issue_array;
	foreach( $issue_array as $issue ) :
		echo '	<li><a href="">'.$issue.'</a></li>';
	endforeach;
?>		
		</ul>
		<div class="clear"></div>
		<p style="margin-bottom:35px;margin-top:5px;"><a href="" style="color:#b9b9b9;font-size:12px;float:right;">不限专题</a></p>
	</div>
	</div>
	<div class="post-filter-box">
		<div class="filter-header">
			<img class="expand-author-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-author-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			按<a href="">作者</a>筛选
		</div>
		<div class="author-filter">
			<ul>
<?php
	global $author_array;
	foreach( $author_array as $author ) :
		echo '	<li><a href="">'.$author.'</a></li>';
	endforeach;
?>
			</ul>
			<div class="clear"></div>
			<p style="margin-bottom:35px;margin-top:5px;"><a href="" style="color:#B9B9B9;font-size:12px;float:right;">所有作者</a></p>
		</div>
	</div>
	<div class="post-filter-box" style="border-bottom: #b9b9b9 dashed 1px;">
		<div class="filter-header">
			<img class="expand-quarter-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-quarter-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			按<a href="">季度</a>筛选
		</div>
		<div class="quarter-filter">
			<ul>
<?php
	global $quarter_array;
	foreach( $quarter_array as $quarter ) :
		echo '	<li><a href="">'.$quarter.'</a></li>';
	endforeach;
?>
			</ul>
			<div class="clear"></div>
			<p style="margin-bottom:35px;margin-top:5px;"><a href="" style="color:#b9b9b9;font-size:12px;float:right;">全部季度</a></p>
		</div>
	</div>
</div>
