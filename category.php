<?php get_header(); $categories = get_the_category(); ?>
<div id="column1" class="grid_8">				
	<div class="column-head">
		<a href="#"><span style="font-size:13px;color:#b9b9b9;">全部政见/ </span></a>
		<a href="#"><b>
			<?php 
				single_cat_title();//echo $categories[0]->name;
			?></b>
		</a>
	</div>
<?php
	if (have_posts()) :
		// put the theme options here

		while (have_posts()) : the_post();
			$post_thumbnail_id = get_post_thumbnail_id();
			echo	'<div class="article-latest">
						<img class="latest-img" width="150" height="150" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'">
						<div class="latest-text">';
			echo	'		<p class="latest-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
							<p class="latest-author">
							<a href="#">'.get_the_author().'</a>
							<span style="font-size:13px;color:#b9b9b9;"> | '.get_the_date('Y-m-d').'</span>
							</p>
							<p class="latest-abstract">'.get_excerpt('96').'</p>
						</div>
					</div>
					<div class="clear"></div>';
		endwhile;
	endif;

?>
<?php wp_pagenavi(); ?>

</div>

<div id="column2" class="grid_4">
	<?php get_sidebar('filter'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
