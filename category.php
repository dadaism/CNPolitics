<?php get_header();?>
<div id="column1" class="grid_7">
	<div><a href="#" style="font-size:13px;color:#b9b9b9;font-weight:300;"><b>全部政见/</b></a> 
		<span style="font-size:15px;color:#000;font-weight:bold;"><?php single_cat_title();?></span>
	</div>
	
<?php
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
	
	//$args = array( 'category' => 1 );

	//$myposts = get_posts( array( 'category' => $cat_id ) );
	/*foreach ( $myposts as $post ) : setup_postdata( $post ); 
		array_push( $pid_array, get_the_ID());
	endforeach; */
	/*$the_query = new WP_Query( array( 'category' => $cat_id ) );
	echo $the_query->found_posts."<br>";
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			//array_push( $pid_array, get_the_ID());
			echo get_the_ID()." ";
		}
	}
	wp_reset_postdata();*/
	/*if (have_posts()) :
		// put the theme options here
		while (have_posts()) : the_post();
			
			//echo get_the_ID()."<br>";
		endwhile;
		wp_reset_postdata(); 
	endif;*/
	//echo count($pid_array);
	//var_dump($pid_array);
	global $authorid_array;
	$authorid_array = get_authorid_bypostid($pid_array);
	global $issue_array;
	$issue_array = array("次贷危机" , "中东局势", "亚洲策略");
	//$issue_array = get_issue_bypostid($pid_array);
	global $quarter_array;
	$quarter_array = get_quarter_bypostid($pid_array);
	$pid_array = pid_filter($pid_array, $authorid, $quarter);
	if ( !empty($pid_array) ) {
		// The Loop
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array('posts_per_page' =>5, 'paged' => $paged, 'post__in' => $pid_array, 'post__not_in' => get_option( 'sticky_posts' ) );
		query_posts($args);
		
		/* the loop */
		if (have_posts()) :
			// put the theme options here
			while (have_posts()) : the_post();
				$post_thumbnail_id = get_post_thumbnail_id();
				echo	'<div class="article-latest">
							<img class="latest-img" width="150" height="150" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'">
							<div class="latest-text">';
				echo	'		<p class="latest-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
								<p class="latest-author">
								<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>
								<span style="font-size:13px;color:#b9b9b9;"> | '.get_the_date('Y-m-d').'</span>
								</p>
								<p class="latest-abstract">'.get_excerpt('96').'</p>
							</div>
						</div>
						<div class="clear"></div>';
			endwhile;
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
<?php 
	echo '<script>
			var authorid = '.json_encode($authorname).';
			var quarter = '.json_encode($quarter).';
			decorate_filter_box(authorid, quarter);
		  </script>';
?>
