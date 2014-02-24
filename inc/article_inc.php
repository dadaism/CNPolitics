<?php
while (have_posts()) : the_post();
	$post_thumbnail_id = get_post_thumbnail_id();
	$charlength = 92;
	$excerpt = get_the_excerpt();
	$class_name = "";
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$class_name = "box-abstract";
	}
	$thumb_url = wp_get_attachment_thumb_url( $post_thumbnail_id );
	if ( empty($thumb_url) )
		$thumb_url = get_template_directory_uri().'/images/default-thumb.png';
	echo	'<div class="article-latest">
				<img class="latest-img" width="148" height="148" src="'.$thumb_url .'">
				<div class="latest-text">
					<p class="latest-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
					<p class="latest-author">
					<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>
					<span style="font-size:13px;color:#b9b9b9;"> | '.get_the_date('Y-m-d').'</span>
					</p>
					<div class="box-abstract" hidden="true" style="display: none;">
						<p class="latest-abstract abstract-full">'.get_the_excerpt().'</p>
					</div>
					<p class="latest-abstract abstract-short" style="display: block;"></p>
				</div>
			</div>
			<div class="clear"></div>';
endwhile;
?>