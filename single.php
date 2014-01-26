<?php get_header(); ?>
<div id="column1" class="grid_8">				
	<div class="post-block">	
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<h1 class="post-head"><?php the_title(); ?></h1>
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
		<!--a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author_meta('display_name');?></a-->
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author();?></a><span style="font-size:14px;color:#b9b9b9;">｜<?php the_date('Y-m-d') ?></span>
	</p>
	<!--p class="post-lead"><?php echo get_the_excerpt();?></p-->
	<div class="post-body">
		<?php the_content(); ?>
		<p></p>
	</div>
	<div class="post-share">
		<p>欢迎分享。如需全文转载，请阅读<a href="#">版权声明</a>。</p>
		<div class="social">
		<ul>
<?php 
	$share_title = "» ". get_the_title(). " 政见 CNPolitics.org "; 
	$pic_url = "";	
	if (has_post_thumbnail( $post->ID ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$pic_url = $image[0];
	}
	$share_href = "http://www.jiathis.com/send/?url=".get_permalink($post->ID)."&title=".$share_title."&pic=".$pic_url."&uid=1657293";
?>
			<li><a href="<?php echo $share_href;?>&webid=tsina" class="sina" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/sina.png"></a></li>
			<li><a href="<?php echo $share_href;?>&webid=tqq" class="tecent" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/tecent.png"></a></li>
			<li><a href="<?php echo $share_href;?>&webid=t163" class="a163" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/a163.png"></a></li>
			<li><a href="<?php echo $share_href;?>&webid=googleplus" class="gplus" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/gplus.png"></a></li>
			<li><a href="<?php echo $share_href;?>&webid=renren" class="renren" style="margin-right:15px;"><img src="<?php bloginfo('template_directory'); ?>/images/renren.png"></a></li>
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
	<div class="comment-head">
		<img style="float:right;padding:8px 0px 8px 10px;" class="expand-comments" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
		<img style="float:right;padding:8px 0px 8px 10px;" class="collapse-comments" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
		<!--p style="font-size:14px;float:right;"><a href="#">发表评论</a> | 阅读<a href=""><?php echo count($comments); ?></a>条评论</p-->
		<p style="font-size:14px;float:right;"><a href="#">发表评论</a> | 阅读<a href="<?php echo get_settings('home')."/?p=".get_the_ID();?>" id="uyan_count_unit">0</a>条评论</p>
		<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=0"></script>
		<p style="font-size:16px;"><b>欢迎真知灼见！</b></p>
	</div>
	<div class="comment-body">
		<?php comments_template();?>
	</div>
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
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/comments.js"></script>
