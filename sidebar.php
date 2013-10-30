<div class="column-head"><a href="#"><b>政见精选</b></a></div>
<?php 
	global $authorid_array;
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
?>

