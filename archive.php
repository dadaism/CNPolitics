<?php get_header(); ?>
<div id="column1" class="grid_7">
	<div><a href="#" style="font-size:13px;color:#b9b9b9;font-weight:300;">全部政见 / </a> 
		<span style="font-size:15px;color:#000;font-weight:bold;"><?php single_cat_title();?></span>
	</div>



<div class="pagination"><?php wp_pagenavi(); ?></div>

<div class="post-end-button back-to-top">
	<p style="padding-top:20px;">回到开头</p>
</div>
<div id="display_bar">
	<img width="556px;" src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
</div>
</div> <!-- End column1 -->

<div id="column2" class="prefix_1 grid_4">	
	<div style="margin-bottom:40px;">
		<a href="" style="float:right;position:relative;color:#b9b9b9;font-size:13px;">« 全部<?php single_cat_title();?></a>
	</div>
	<?php get_sidebar('filter'); ?>
</div><!-- End column2 -->
<?php get_footer();?>
