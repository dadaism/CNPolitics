<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>

<?php
if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
else :
	$curauth = get_userdata(intval($author));
endif;
?>

<h2><?php echo $curauth->display_name; ?></h2>
<dl>
<dt>个人档案：</dt>
<dd><?php echo $curauth->user_description; ?></dd>
<dt>个人网站/博客：</dt>
<dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
</dl>

<?php 
	//echo $curauth->ID;
	// The Loop
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('posts_per_page' =>5, 'paged' => $paged, 'author' => $curauth->ID );
	query_posts($args);
	if (have_posts()) : 
		while (have_posts()) : the_post();
?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<p class="latest-abstract"><?php echo get_excerpt('96') ?></p>
<?php	endwhile;
	else:
	
	endif;
?>
	<div class="post-end-button back-to-top">
	<p style="padding-top:20px;">回到开头</p>
</div>
<div id="display_bar">
	<img width="556px;" src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
</div>
<div class="pagination"><?php wp_pagenavi(); ?></div>
<?php get_footer(); ?>