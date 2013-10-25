<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>


<h1><?php the_title(); ?></h1></div>

<?php 
	query_posts('showposts=-1');
	if (have_posts()) : 
		while (have_posts()) : 
			the_post();
		endwhile;
	else :
?>
	<h2>Not Found</h2>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php
endif;
?>


<?php get_footer(); ?>
