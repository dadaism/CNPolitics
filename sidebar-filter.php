<div class="post-sidebar-filter">
	<div class="post-filter-box">
		<div class="filter-header">
			<img class="expand-topic-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-topic-filter" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			按<a href="">专题</a>筛选
		</div>
	<div class="topic-filter">
		<ul>
<?php
	$page_url = preg_replace('/page\/[0-9]+\//','',$_SERVER['REQUEST_URI']);
	//echo $page_url;
	global $issue_array;
	foreach( (array)$issue_array as $key => $issue ) :
		echo '	<li><a class="issue-filter-a" href="'.add_query_arg('issue',$issue_array[$key], $page_url).'">'.$issue.'</a></li>';
	endforeach;
?>		
		</ul>
		<div class="clear"></div>
		<p style="margin-bottom:35px;margin-top:5px;"><a href="<?php echo preg_replace('/(&|\?)(issue=.*)(&|$)/','$3',$page_url); ?>"  style="color:#b9b9b9;font-size:12px;float:right;"  class="issue-all-a">不限专题</a></p>
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
	global $authorid_array;
	$author_array = array();
	foreach ( $authorid_array as $authorid ) {
		$user_info = get_userdata($authorid);
		array_push( $author_array, $user_info->display_name);
	}
	foreach( (array)$author_array as $key => $author ) :
		echo '	<li><a class="author-filter-a" href="'.add_query_arg('authorid',$authorid_array[$key], $page_url).'">'.$author.'</a></li>';
	endforeach;
?>			
			</ul>
			<div class="clear"></div>
			<p style="margin-bottom:35px;margin-top:5px;"><a href="<?php echo preg_replace('/(&|\?)authorid=[0-9]+/','',$page_url); ?>" style="color:#B9B9B9;font-size:12px;float:right;" class="author-all-a">所有作者</a></p>
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
	foreach( $quarter_array as $key => $quarter ) :
		echo '	<li><a class="quarter-filter-a" href="'.add_query_arg('quarter',$quarter_array[$key],$page_url).'">'.$quarter.'</a></li>';
	endforeach;
?>
			</ul>
			<div class="clear"></div>
			<p style="margin-bottom:35px;margin-top:5px;"><a href="<?php echo preg_replace('/(&|\?)(quarter=[0-9].*)(&|$)/','$3',$page_url); ?>" style="color:#b9b9b9;font-size:12px;float:right;" class="quarter-all-a">全部季度</a></p>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/filter_box.js"></script>
