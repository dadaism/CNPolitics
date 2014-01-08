<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
<div id="column1" class="grid_7">
	<div><b style="font-size: 15px;">全部政见</b></div>
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
	$pid_array = get_postid_all();
	global $issue_array;
	global $authorid_array;
	global $quarter_array;
	$issue_array = get_issues_bypostids($pid_array);
	$authorid_array = get_authorids_bypostids($pid_array);
	$quarter_array = get_quarters_bypostids($pid_array);
	$pid_array = pid_filter($pid_array, $issue, $authorid, $quarter);
	if ( !empty($pid_array) ) {
		// The Loop
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array('posts_per_page' =>10, 'paged' => $paged, 'post__in' => $pid_array, 'post__not_in' => get_option( 'sticky_posts' ) );
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

	<div class="pagination"><?php wp_pagenavi(); ?></div>

	<div class="post-end-button back-to-top">
		<p style="padding-top:20px;">回到开头</p>
	</div>
	<div id="display_bar">
		<img width="556px;" src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
	</div>
</div> <!-- End column1 -->

<div id="column2" class="prefix_1 grid_4">	
	<div style="margin-bottom:40px;">
		<a href="" style="float:right;position:relative;color:#b9b9b9;font-size:13px;">« 全部<?php single_cat_title();?></a>
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