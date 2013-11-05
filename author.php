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
	<!--img src="<?php bloginfo('template_directory'); ?>/images/avatar.png"-->
	<?php echo get_avatar($curauth->user_email); ?>
	<!--?php var_dump($curauth->user_email); ?-->
	<p style="margin-top:15px;"><?php echo $curauth->display_name; ?></p>
	<p style="font-weight:normal;font-size:14px;color:#b9b9b9;">观察员</p>
</div>
		
<div id="column1">
	<div class="observer-intro">
		<p>
		
		<?php echo nl2br($curauth->user_description); ?>
		</p>
		<a href="<?php echo $curauth->user_url; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/sina.png"></a>
		<a href=""><img src="<?php bloginfo('template_directory'); ?>/images/copy-link.png"></a>
		<a href=""><img src="<?php bloginfo('template_directory'); ?>/images/email-link.png"></a>
	</div>
</div>

<div class="clear"></div>
<div id="display_bar">
	<img src="<?php bloginfo('template_directory'); ?>/images/shadow_middle.png">
</div>

<div class="observer-summary">
<?php  
	$reg_date = $curauth->user_registered;
	echo date("Y 年 n 月", strtotime($reg_date)).'至今，已发表 '.count_user_posts($curauth->ID).' 篇政见';

?>
	
</div>
<?php 
	//echo $curauth->ID;
	// The Loop
	$count = 0;
	$posts_per_column = 3;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('posts_per_page' =>$posts_per_column*2, 'paged' => $paged, 'author' => $curauth->ID );
	query_posts($args);
	if (have_posts()) : 
		while (have_posts()) : the_post();
			//echo $count;
			if ( $count==0 )
				echo '<div id="column1" class="grid_5">';
			if ( $count==$posts_per_column )
				echo '</div><div id="column2" class="prefix_1 grid_5">';
			
			echo '<div class="article-latest">
					<div class="latest-text-observer">
						<p class="latest-head"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></p>
						<div class="box-abstract"><p class="latest-abstract">'.get_excerpt('96').'</p></div>
					</div>
				</div>
				<div class="clear"></div>';
			$count = $count + 1;
		endwhile;
		echo '</div>';
	else:
	
	endif;
?>
<div class="clear"></div>
<div class="pagination"><?php wp_pagenavi(); ?></div>
<div class="post-end-button back-to-top">
	<p style="padding-top:20px;">回到开头</p>
</div>
<div id="display_bar">
	<img src="<?php bloginfo('template_directory'); ?>/images/shadow_middle.png">
</div>
<?php get_footer(); ?>
<style>
/*10 _ Observer Page
---------------------------------------------------------------------------------------*/
.observer-intro	{width: 500px;margin:0 auto;text-align: center;padding-bottom: 20px;}
.observer-intro p {margin-bottom:20px;line-height: 28px;font-size: 16px;color: #777;text-align: left;}
.observer-intro img {padding:10px 10px 0px 10px;}
.observer-summary {margin: 0 auto;text-align: center;font-size: 15px;color: #B9B9B9;}
</style>
