<?php get_header(); ?>
<div id="column1" class="grid_8">				
	<div class="post-block">	
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<p class="post-head"><a href="#"><?php the_title(); ?></a></p>
	<p class="post-subhead"><?php 
				$subtitle = get_post_meta( $post->ID, 'cnpolitics_subtitle', true );
				echo $subtitle;?></p>
	<p class="post-tag">
	<?php 
		$posttags = get_the_tags();
		if ($posttags) {
  			foreach($posttags as $tag) {
   				echo '#'.$tag->name.' '; 
  			}
		}
	?>
	</p>
	<p class="post-author">
		<a href="#"><?php echo get_the_author(); ?></a>
		<span style="font-size:14px;color:#b9b9b9;">| <?php the_date('Y-m-d') ?></span>
	</p>
	<p class="post-lead"><?php echo get_the_excerpt();?></p>
	<div class="post-body">
		<?php the_content(); ?>
		<p></p>
	</div>
	<div class="post-share">
		<p>欢迎分享。如需全文转载，请阅读<a href="#">版权声明</a>。</p>
		<div class="social">
		<ul>
			<li><a href="#" class="sina" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/sina.png"></a></li>
			<li><a href="#" class="tecent" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/tecent.png"></a></li>
			<li><a href="#" class="a163" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/a163.png"></a></li>
			<li><a href="#" class="gplus" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/gplus.png"></a></li>
			<li><a href="#" class="renren" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/renren.png"></a></li>
			<li><a href="#" class="copy-link" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/copy-link.png"></a></li>
		</ul>
		</div> <!-- icon list -->
	</div>	<!-- social box -->
	<div class="post-end-button back-to-top">
		<p style="padding-top:20px;">回到开头</p>
	</div>
	<div id="display_bar">
		<img src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
	</div>

	<?php comments_template();?>
	</div> <!-- post-block end -->
</div> <!-- column 1 end -->
<?php
endwhile;
?>




<?php
else :
?>

<div class="oneblog_top"></div>
<div class="single_post">
<h2>Not Found</h2>
<p>Sorry, but you are looking for something that isn't here.</p>
</div><!--/single_post-->
<div class="oneblog_btm"></div>

<?php
endif;
?>

<div id="column2" class="grid_4">
	<?php get_sidebar('info'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
