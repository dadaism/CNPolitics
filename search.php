<!--?php get_header(); ?-->
<?php require_once( $cnpolitics_theme_dir.'/inc/header_inc.php' ); ?>
<!-- rewrite css for popup search frame -->
<style type="text/css">
@import url("<?php bloginfo('template_directory');?>/css/search.css");
</style>
<div id='search-page'>
   <!-- <div class='close'></div> the close button-->
	<div class="search-box">
	<!--div id="search-box"-->
		<form id="search-form" method="get" action="<?php bloginfo('siteurl'); ?>/">
			<input type="text" name="s" value="<?php echo $s;?>" onblur="if (this.value==''){this.value='搜索'}" onfocus="if (this.value=='搜索') {this.value=''}" class="topsearch_input"/>
			<input type="image" class="topsearch_img" src="<?php bloginfo('template_directory'); ?>/images/search.png"/>
		</form>
		<div id='box-sample-fancybox'></div>
		<div class='search-box-shadow'></div>
<?php
	$mySearch = new WP_Query("s=$s  & showposts=-1 & post_type=post ");
	$num = $mySearch->post_count;
	wp_reset_query();
	echo '<p>'.$num.'条结果</p>';
?>
	</div> <!-- search-box -->
	<div class='search-results'>
<?php
	$key_word = get_search_query();
	//echo $key_word;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('posts_per_page' =>8, 'paged' => $paged, 's' => $key_word, 'post_type' => 'post' );
	query_posts($args);
 	if ( have_posts() ):
		while ( have_posts() ) : the_post();
			$title = get_the_title();
    		$content = strip_tags(get_the_content());
    		$keys = explode(" ",$s);
    		$pos = mb_strpos($content,$keys[0],1);
    		//var_dump( $pos );
    		if($pos&&$pos>10){//如果搜索关键字位置有了返回值，且大于30
        		$content = mb_substr($content,$pos-10,80);//substr会出现乱码，
    		}else{
        		$content = mb_substr($content,0,80);
    		}
    		$title = preg_replace('/('.implode('|', $keys) .')/iu','<span class="search-key">\0</span>',$title);
    		$content = preg_replace('/('.implode('|', $keys) .')/iu','<span class="search-key">\0</span>',$content);

    		$link = get_permalink($post->ID);
?>
			<div class='search-results-item'>
				<div class='result-head'>
					<a href="<?php  echo $link;?>"><?php echo $title; ?> | 政见 CNPolitics.org </a>
				</div>
				<p class="result-abstract"><?php echo "...".$content."..."; ?></p>
				<div class='result-link'>
					<a href='<?php  echo $link;?>'><?php  echo str_replace("http://", "", $link);?></a>
				</div>
    		</div>
<?php 
		endwhile;
	else : 
?>
	<article>
		<div class="entry-content">
			<p style="text-align: center;"><?php _e( '没有找到相关内容', 'leizi' ); ?></p>
		</div>
	</article>
<?php 
	endif; 
?>
	</div>
<div class="pagination"><?php wp_pagenavi(); ?></div>
</div><!--search-page ends-->
<script>
	$(document).ready(function() {
		//var mHeight = $( document ).height();
		$("a:not(.page-numbers)").attr("target", "_parent");
		//alert( $( window ).height() );
		//alert( $(".fancybox-inner").css("height"));
		//alert( $("iframe").css("height"));
		//$("#search-page").css("height", mHeight);
		//alert( $("#search-page").css("height") );
	});
</script>
<?php require_once( get_template_directory().'/inc/footer_inc.php' ); ?>
