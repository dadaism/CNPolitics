<?php get_header(); ?>
<style type="text/css">
@import url("<?php bloginfo('template_directory');?>/css/author.css");
</style>
<?php
if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
else :
	$curauth = get_userdata(intval($author));
endif;
?>
<div id="researcher-avatar">
	<!--?php echo get_avatar($curauth->user_email); ?-->
	<?php echo get_simple_local_avatar($curauth->user_email, 150); ?>
	<p style="margin-top:15px;"><?php echo $curauth->display_name; ?></p>
	<p style="font-weight:normal;font-size:14px;color:#b9b9b9;"><?php echo get_the_author_meta('cnpolitics_title');?></p>
</div>
		
<div id="column1">
	<div class="observer-intro">
		<p>
		
		<?php echo nl2br($curauth->user_description); ?>
		</p>
<?php
	$weibo = get_the_author_meta('cnpolitics_weibo');
	if ( !empty($weibo) ) {
		echo '
		<a href="'. $weibo . '"><img src="'.get_template_directory_uri().'/images/sina.png"></a>
			';
	}
	$website = $curauth->user_url;
	if ( !empty($website) ) {
		echo '
		<a href="'. $website . '"><img src="'.get_template_directory_uri().'/images/copy-link.png"></a>
			';
	}
	$pubemail = get_the_author_meta('cnpolitics_pubemail');
	if ( !empty($pubemail) ) {
		echo '
		<a href="mailto:'. $pubemail .'"><img src="'. get_template_directory_uri().'/images/email-link.png"></a>
			';
	}
?>
		<!--a href="" onclick="copyToClipboard('<?php echo get_author_posts_url($curauth->ID);?>')"; ><img src="<?php bloginfo('template_directory'); ?>/images/copy-link.png"></a!-->
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
			$post_thumbnail_id = get_post_thumbnail_id();
			$charlength = 92;
			$excerpt = get_the_excerpt();
			$class_name = "";
			if ( mb_strlen( $excerpt ) > $charlength ) {
				$class_name = "box-abstract";
			}
			if ( $count==0 )
				echo '<div id="column1" class="grid_5">';
			if ( $count==$posts_per_column )
				echo '</div><div id="column2" class="prefix_1 grid_5">';
			
			echo '<div class="article-latest">
					<div class="latest-text-observer">
						<p class="latest-head"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></p>
						<div class="'.$class_name.'">
							<p class="latest-abstract abstract-full" hidden="true">'.get_the_excerpt().'</p>
							<p class="latest-abstract abstract-short">'.get_excerpt($charlength).'</p>
						</div>
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
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/abstract.js"></script>
