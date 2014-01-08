<?php  get_header();?>

<div id="column1" class="grid_7">
	<div class="column-head">
		<b>最新发表</b><span style="font-size:13px;color:#b9b9b9;">｜</span><a href="/archive/"><span style="font-size:13px;color:#b9b9b9;">阅读更多 »</span></a>
	</div>

<?php 
	query_posts('numberposts=8' );
		
	/* the loop */
	if (have_posts()) :
		// put the theme options here
		global $cnpolitics_theme_dir;
		require_once( $cnpolitics_dir.'/inc/article_inc.php' );
	else:
		// No posts found
	endif;
?>

</div>

<div id="column2" class="prefix_8 grid_4.1">
	<?php get_sidebar(); ?>
</div>
<div class="clear"></div>
		
<div id="display_bar">
		<img src="<?php bloginfo('template_directory'); ?>/images/shadow_middle.png">
</div>


<div id="additional">
	<div id="graphics" class="grid_6_1">
		<div class="additional-text-graphics">
			<div class="additional-head">
			<?php
				$category_obj = get_category_by_slug('infographic'); 
    			$category_id = $category_obj->term_id;
    			$category_link = get_category_link( $category_id );
				echo '<b>读图识政治</b>'; 
				echo '<a href="'.$category_link.'"><span style="font-size:13px;color:#b9b9b9;font-weight:500;">｜更多信息图 »</span></a>';
			?>
			</div>
			<p class="additional-abstract">政见的信息可视化基于对公开资料的搜集和分析，辨识蕴藏在单纯数据背后的事实。</p>
			<p class="additional-abstract">政见力求将资讯以全新的视觉形式表达，展示我们对具体事件的观点。</p>
		</div>
		<div class="additional-img1">
		<?php
			$postslist = get_posts( array( 'numberposts' => '3', 'category' => $category_id, 'orderby' => 'rand' ) );
			foreach ($postslist as $post) {
				setup_postdata($post);
				$post_thumbnail_id = get_post_thumbnail_id();
				echo '<a href="'.get_permalink().'"><img width="180" height="180" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'"></a>';
			}
		?>		
		</div>
		<!--div class="dots">
			<a href="#" data-slidejs-item="0"><div class="circle1-1"></div></a>
			<a href="#" data-slidejs-item="1"><div class="circle1-2"></div></a>
			<a href="#" data-slidejs-item="1"><div class="circle1-3"></div></a>
		</div-->
	</div>

	<div id="collections" class="grid_5_1 prefix_1">
		<div class="additional-text-collections">
			<div class="additional-head">
			<?php
				$category_obj = get_category_by_slug('publish'); 
    			$category_id = $category_obj->term_id;
    			$category_link = get_category_link( $category_id );
				echo '<b>政见合集</b>';
				echo '<a href="'.$category_link.'"><span style="font-size:13px;color:#b9b9b9;font-weight:500;">｜更多合集 »</span></a>';
			?>
			</div>
			<p class="additional-abstract">合辑是由政见网站内容重新编辑并整合而成的电子出版物。每个季度合辑都会与你见面。</p>
			<p class="additional-abstract">另与电子书城“字节社”合作发行 iOS/Android 版，阅读体验极佳。</p>
		</div>
		<div class="additional-img2">
		<?php
			$postslist = get_posts( array( 'numberposts' => '3', 'category' => $category_id, 'orderby' => 'rand' ) );
			foreach ($postslist as $post) {
				setup_postdata($post);
				$post_thumbnail_id = get_post_thumbnail_id();
				echo '<a href="'.get_permalink().'"><img width="120" height="180" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'"></a>';
			}
		?>	
		</div>
<!--	<div class="dots">
			<div class="circle1-1"></div>
			<div class="circle1-2"></div>
			<div class="circle1-3"></div>
		</div>-->
	</div>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/abstract.js"></script>