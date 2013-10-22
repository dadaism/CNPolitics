<?php get_header(); ?>

<div id="leftandright">
<div id="leftcontent">

<div class="oneblog_top"></div>
<div class="single_post">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="thetitle">
<h1><?php the_title(); ?></h1></div>

<?php
$minism_postimage_disable = get_option('minism_postimage_disable');

if ($minism_postimage_disable != 'true') {
$minism_postimage_priority = get_option('minism_postimage_priority', 'wp');
$thereisimage = zv_get_postimage();
if($thereisimage) {
?>
<div class="post_image">
<img alt="Post image of <?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo $thereisimage; ?>" />
</div>
<?php
} 
}
?>

<div class="post_details">
<span class="right"><a href="#respond"><?php echo $post->comment_count; ?> comments</a></span>
<div class="clear"></div>
</div>

<div class="the_content">
<?php the_content(); ?><div class="clear"></div>
</div><!--/the_content-->

<?php wp_link_pages('before=<div id="multipage-links">Pages : &after=</div>'); ?>

<div class="after_post_details">
<span class="left">Posted by <?php the_author(); ?> &nbsp;&nbsp;@&nbsp;&nbsp; <?php the_time('j F Y') ?></span>
<span class="right"><a href="<?php echo wp_get_shortlink(); ?>" uyan_identify="true" >0条评论</a></span>
<div class="clear"></div>
<span class="left"><?php the_tags('Tags : ', ' , ', ''); ?></span>
<span class="right adminedit"><?php edit_post_link('Edit This Page','',''); ?></span>
<div class="clear"></div>
</div>


<?php
$zenverse_global_adsense_id = get_option('zenverse_global_adsense_id');
$minism_adsense_afterpost_enable = get_option('minism_adsense_afterpost_enable');
if ($zenverse_global_adsense_id && $minism_adsense_afterpost_enable == 'true'){ 
?>
<div class="blogsep"></div>
<div class="adsense-afterpost">
<script type="text/javascript">
//<![CDATA[
google_ad_client = "pub-<?php echo $zenverse_global_adsense_id; ?>";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text";
google_ad_channel = "";
google_color_border = "f6f6f6";
google_color_bg = "f6f6f6";
google_color_link = "555555";
google_color_text = "555555";
google_color_url = "444444";
google_ui_features = "rc:0";
//]]>
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
<?php } ?>


<?php
$minism_socialbookmark_page_enable = get_option('minism_socialbookmark_page_enable');
if ($minism_socialbookmark_page_enable == 'true') {
?>
<div class="blogsep"></div>
<div class="extra_content">
<h3>Share This Post</h3>
<div class="socialbmark">

	<a title="RSS" href="<?php bloginfo('rss2_url');?>"><img src="<?php bloginfo('template_url');?>/images/sb_rss.gif" alt="RSS" /></a>
	<a title="Digg" href="http://digg.com/submit?url=<?php the_permalink() ?>"><img src="<?php bloginfo('template_url');?>/images/sb_digg.gif" alt="Digg" /></a>
	<a title="Twitter" href="http://twitter.com/home?status=Currently%20reading%20<?php the_permalink() ?>"><img src="<?php bloginfo('template_url');?>/images/sb_twitter.gif" alt="Twitter" /></a>
	<a title="StumbleUpon" href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>"><img src="<?php bloginfo('template_url');?>/images/sb_su.gif" alt="StumbleUpon" /></a>
	<a title="Delicious" href="http://del.icio.us/post?url=<?php the_permalink() ?>"><img src="<?php bloginfo('template_url');?>/images/sb_del.gif" alt="Delicious" /></a>
	<a title="Technorati" href="http://www.technorati.com/faves?add=<?php the_permalink() ?>"><img src="<?php bloginfo('template_url');?>/images/sb_techno.gif" alt="Technorati" /></a>
</div>
</div>
<?php
}
?>


<div class="blogsep"></div>
<div class="extra_content">
<h3 class="left"><?php echo $post->comment_count; ?> Comments</h3>
<?php if ( comments_open() ) : ?>
<div class="replyjump"><a rel="nofollow" href="#reply">Add Comment</a></div>
<?php endif; ?>
<div class="clear"></div>
</div>

<?php comments_template();?>

</div><!--/single_post-->
<div class="oneblog_btm"></div>

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

</div><!--/leftcontent-->


<?php get_sidebar(); ?>
<div class="clear"></div>
</div><!--/leftandright-->
<?php get_footer(); ?>