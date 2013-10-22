<?php get_header(); ?>

<div id="leftandright">
<div id="leftcontent">

<div class="the_category">
You searched for "<?php the_search_query(); ?>"
</div><!--/oneblog-->

<?php if (have_posts()) : 
$minism_postthumbnail_disable = get_option('minism_postthumbnail_disable');
$minism_thumb_priority = get_option('minism_thumb_priority', 'wp');
$minism_postthumbnail_default = get_option('minism_postthumbnail_default');
?>
<?php while (have_posts()) : the_post(); ?>

<?php
if ($minism_postthumbnail_disable != 'true') {

/* post thumbnail */
$thereisimage = zv_get_postthumbnail();
if(!$thereisimage) {
  if ($minism_postthumbnail_default) { $thereisimage = $minism_postthumbnail_default; } else {
  $thereisimage = get_bloginfo('template_directory').'/images/blank.jpg';
  }
}
$minism_thumbnail_code = '<div class="thumbnail_holder"><a title="'.htmlspecialchars($post->post_title).'" href="'.get_permalink($post->ID).'"><img class="thumbnail" src="'.$thereisimage.'" alt="Post Thumbnail of '.htmlspecialchars($post->post_title).'" /></a></div>';

$extrawidth = '';
} else {
$minism_thumbnail_code = '';
$extrawidth = ' extrawidth';
}
?>


<div class="oneblog">

<?php echo $minism_thumbnail_code; ?>

<div class="excerpt<?php echo $extrawidth; ?>">
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php the_excerpt(); ?>

</div><!--/excerpt-->
<div class="clear"></div>

<div class="excerpt_details">
<span class="left">
<img src="<?php bloginfo('template_directory'); ?>/images/folder.gif" alt="" /> <?php the_category(','); ?>
 &nbsp;&nbsp;&nbsp; <img src="<?php bloginfo('template_directory'); ?>/images/date.gif" alt="" /> <?php the_time('j M Y'); ?>
</span>
<span class="right"><img src="<?php bloginfo('template_directory'); ?>/images/comment.gif" alt="" /> <a href="<?php echo wp_get_shortlink(); ?>" uyan_identify="true" >0条评论</a></span>
<div class="clear"></div>
</div>

</div><!--/oneblog-->


<?php

endwhile;

include('wp-pagenavi.php');
if (function_exists('wp_pagenavi')) { wp_pagenavi(); }
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
