<?php
while (have_posts()) : the_post();
	$post_thumbnail_id = get_post_thumbnail_id();
	$charlength = 92;
	$excerpt = get_the_excerpt();
	$class_name = "";
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$class_name = "box-abstract";
	}
	echo	'<div class="article-latest">
				<img class="latest-img" width="150" height="150" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'">
				<div class="latest-text">
					<p class="latest-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
					<p class="latest-author">
					<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>
					<span style="font-size:13px;color:#b9b9b9;"> | '.get_the_date('Y-m-d').'</span>
					</p>
					<div class="'.$class_name.'">
						<p class="latest-abstract abstract-full" hidden="true">'.get_the_excerpt().'</p>
						<p class="latest-abstract abstract-short">'.get_excerpt($charlength).'</p>
					</div>
				</div>
			</div>
			<div class="clear"></div>';
endwhile;
?>