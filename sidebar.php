<div class="column-head"><a href="#"><b>政见精选</b></a></div>
<?php 
/*	global $authorid_array;
	global $issue_array;
	global $quarter_array;
	$postslist = get_posts( 'numberposts=6&orderby=rand' );
	foreach ($postslist as $post) {
		setup_postdata($post);
		echo '<div class="article-select-first">
				<p class="select-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
					<p class="select-abstract">'.get_excerpt('70').'</p>
				</div>';
	}
*/
	$sticky = get_option( 'sticky_posts' );
	//var_dump($sticky);
	if ( !empty($sticky) ) {
		$postslist = get_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1, 'orderby' => 'rand', 'posts_per_page'=>6 ) );
		foreach ($postslist as $post) {
			setup_postdata($post);
			echo '<div class="article-select-first">
					<p class="select-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
						<p class="select-abstract">'.get_excerpt('70').'</p>
					</div>';
		}
	}
?>

