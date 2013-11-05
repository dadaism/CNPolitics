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
<div id="researcher-avatar">
	<img src="<?php bloginfo('template_directory'); ?>/images/avatar.png">
	<p style="margin-top:15px;"><?php echo $curauth->display_name; ?></p>
	<p style="font-weight:normal;font-size:14px;color:#b9b9b9;">观察员</p>
</div>
		
<div id="column1">
	<div class="observer-intro">
		<?php echo $curauth->user_description; ?>
		<a href="<?php echo $curauth->user_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/sina-link.png"></a>
		<a href=""><img src="<?php bloginfo('template_directory'); ?>/images/copy-link.png"></a>
		<a href=""><img src="<?php bloginfo('template_directory'); ?>/images/email-link.png"></a>
	</div>
</div>

<div class="clear"></div>
<div id="display_bar">
	<img src="<?php bloginfo('template_directory'); ?>/images/shadow_middle.png">
</div>

<div class="observer-summary">
	2012 年 8 月至今，已发表 18 篇政见
</div>
<?php 
	//echo $curauth->ID;
	// The Loop
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('posts_per_page' =>5, 'paged' => $paged, 'author' => $curauth->ID );
	query_posts($args);
	if (have_posts()) : 
		while (have_posts()) : the_post();
			echo '<div class="article-latest">
					<div class="latest-text-observer">
						<p class="latest-head"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></p>
						<div class="box-abstract"><p class="latest-abstract">'.get_the_excerpt().'</p></div>
					</div>
				</div>
				<div class="clear"></div>';
			/*echo '	<div class="article-latest">
						<div class="latest-text-observer">
							<p class="latest-head"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>
						<div class="box-abstract"><p class="latest-abstract">'.get_excerpt('96').'</p></div>
					</div>
				</div>
				<div class="clear"></div>';*/
		endwhile;
	else:
	
	endif;
?>
<div class="clear"></div>
<div class="pagination"><?php wp_pagenavi(); ?></div>
<div class="post-end-button back-to-top">
	<p style="padding-top:20px;">回到开头</p>
</div>
<div id="display_bar">
	<img width="556px;" src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
</div>
<?php get_footer(); ?>