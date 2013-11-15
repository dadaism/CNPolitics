<?php get_header(); ?>
<?php
	$key_word = get_search_query();
	echo $key_word;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('posts_per_page' =>8, 'paged' => $paged, 's' => $key_word );
	query_posts($args);
 	if ( have_posts() ):
		while ( have_posts() ) : the_post();?>
		<div><a href="<?php  echo get_permalink($post->ID); ?>"><?php the_title(); ?> | 政见 CNPolitics.org </a></div>
		<div class="box-abstract">
			<p class="latest-abstract"><?php echo get_excerpt('96'); ?></p>
		</div>
<?php 
		endwhile;?>
<?php	else : ?>
<article>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( '没有找到该文章', 'leizi' ); ?></h1>
	</header>
	<div class="entry-content">
		<p><?php _e( '抱歉没有找到该文章', 'leizi' ); ?></p>
	</div>
</article>
<?php endif; ?>

<div class="pagination"><?php wp_pagenavi(); ?></div>
<?php get_footer(); ?>
