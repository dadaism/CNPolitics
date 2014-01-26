<?php get_header();?>
<?php 
	$cat =  get_the_category() ; 
?>
<div id="column1" class="grid_7">
	<div><a href="<?php echo "/archive/";?>" style="font-size:13px;color:#b9b9b9;font-weight:300;">全部政见 / </a> 
		<span style="font-size:15px;color:#000;font-weight:bold;"><?php single_cat_title();?></span>
	</div>
	
<?php
	$issue = isset($_GET['issue']) ? $_GET['issue'] : '';
	$authorid = isset($_GET['authorid']) ? $_GET['authorid'] : '';
	$quarter = isset($_GET['quarter']) ? $_GET['quarter'] : '';
	if ($authorid=='')
			$authorname = '';
	else {
			$user_info = get_userdata($authorid);
			$authorname = $user_info->display_name;
	}
	
	$cat_id = get_queried_object_id();
	//echo $cat_id."<br>";
	$pid_array = get_postid_bycatid($cat_id);
	//echo count($pid_array);
	//var_dump($pid_array);
	global $issue_array;
	global $authorid_array;
	global $quarter_array;
	
	//$issue_array = array("次贷危机" , "中东局势", "亚洲策略");
	$issue_array = get_issues_bypostids($pid_array);
	$authorid_array = get_authorids_bypostids($pid_array);
	$quarter_array = get_quarters_bypostids($pid_array);
	$pid_array = pid_filter($pid_array, $issue, $authorid, $quarter);
	if ( !empty($pid_array) ) {
		// The Loop
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// The following configuration of args would cause problem for page navigation
		//$args = array('posts_per_page' =>5, 'paged' => $paged, 'post__in' => $pid_array, 'post__not_in' => get_option( 'sticky_posts' ) );
		// In the admin panel, if you set the "posts_per_page" bigger than queried value here (e.g. 5)
		// Error message would be "Page not found"
		// To read the default configuration, use get_option('posts_per_page')
		$args = array('paged' => $paged, 'post__in' => $pid_array, 'post__not_in' => get_option( 'sticky_posts' ) );
		query_posts($args);
		
		/* the loop */
		if (have_posts()) :
			// put the theme options here
			global $cnpolitics_dir;
			require_once( $cnpolitics_dir.'/inc/article_inc.php' );
		else:
			// No posts found
		endif;
	}

?>
<div class="post-end-button back-to-top">
	<p style="padding-top:20px;">回到开头</p>
</div>
<div id="display_bar">
	<img width="556px;" src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
</div>
<div class="pagination"><?php wp_pagenavi(); ?></div>
</div> <!-- End column1 -->

<div id="column2" class="prefix_1 grid_4">
	<div style="margin-bottom:40px;">
		<a href="<?php echo get_category_link($cat[0]->cat_ID); ?>" style="float:right;position:relative;color:#b9b9b9;font-size:13px;">« 全部<?php echo $cat[0]->name;?></a>
	</div>
	<?php get_sidebar('filter'); ?>
</div><!-- End column2 -->
<?php get_footer();?>
<?php
	echo '<script>
			var issue = '.json_encode($issue).';
			var authorid = '.json_encode($authorname).';
			var quarter = '.json_encode($quarter).';
			decorate_filter_box(issue, authorid, quarter);
		 </script>';
?>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/abstract.js"></script>
