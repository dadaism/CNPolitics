<?php
if ( isset($_GET['topic_id']) ) :
	global $wpdb;
	global $toptopics;
	global $topic_image_dir;
	$tid = $_GET['topic_id']; 	// topic id
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	$t = get_topic_byID($tid);
	$rschs = get_rsch_bytopic($tid);
	if ( empty($t) ) :
		echo '<h2>你所要找的主题不存在！</h2>';
		require_once('404.php');
	else :
		//$t = $topics['0'];
		echo '	<div id="researcher-avatar">
					<img src="'.get_bloginfo('template_directory').$t->img_path.'">
					<p style="margin-top:15px;">'.$t->subject.'</p>
				</div>
				<div id="column1" class="grid_6">
				<div class="researcher-intro">
					<p><span style="font-weight:bolder;color:#000;line-height:50px;">主题简介</b></p>
					<p>'.$t->intro.'</p>
				</div>
				</div>
				<div id="column2" class="prefix_7 grid_4.1">
					<div class="researcher-topic">
						<p>
							<span style="color:#000;font-weight:bolder;line-height:50px;">相关研究者</span>
						</p>
						<ul>';
						if ( !empty($rschs) ) {
							$count = 0;
							foreach ( $rschs as $r ) {
								//$rsch = explode("（",$rscher);
								echo '<li><a href="'.get_bloginfo('url')."/researcher/?rsch_id=".$r->id.'">'.$r->name. '</a> </li>';
								$count = $count + 1;
								//if ( $count == 4 )	break;
							}
						}
		echo '
						</ul>
					</div>
				</div>
				<div class="clear"></div>
				<div id="display_bar">
					<img src="'.get_bloginfo('template_directory').'/images/shadow_middle.png"</img>
				</div>

				<div id="column1" class="grid_7">
				<div><a href="#" style="font-size:13px;color:#b9b9b9;font-weight:300;"><b>全部政见/</b></a> 
					<span style="font-size:15px;color:#000;font-weight:bold;">'.$t->subject.'</span>
				</div>';

	// get post id via rsch_id
	$pid_array = get_postid_bytopicid($tid);
	echo count($pid_array);
	$author_array = array("张三" , "李四", "娃哈哈", "囧", "去呢的", "啥","神码");
	$author_array = get_authorid_bypostid($pid_array);
	$issue_array = array("次贷危机" , "中东局势", "亚洲策略");
	//$issue_array = get_issue_bypostid($pid_array);
	$quarter_array = array("2013年春","2012年冬","2012年秋","2012年夏");
	// The Loop
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('posts_per_page' =>5, 'paged' => $paged, 'post__in' => $pid_array );
	query_posts($args);

	/* the loop */
	if ( have_posts() ) : 
		while (have_posts()) : the_post();
			$post_thumbnail_id = get_post_thumbnail_id();
			echo '<div class="article-latest">
					<img class="latest-img" width="150" height="150" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'">
					<div class="latest-text">';
			echo '		<p class="latest-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
						<p class="latest-author"><a href="#">'.get_the_author().'</a><span style="font-size:13px;color:#b9b9b9;"> | '.get_the_date('Y-m-d').'</span></p>
						<div class="box-abstract"><p class="latest-abstract">'.get_excerpt('96').'</p></div>		
				  	</div>
				  </div>
				  <div class="clear"></div>';
			endwhile;
			//previous_posts_link();
			//next_posts_link();
		else :
			// No posts found
	endif;
?>
<!--?php posts_nav_link(); ?-->
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
		<a href="" style="float:right;position:relative;color:#b9b9b9;font-size:13px;">« 全部<?php echo $t->subject;?></a>
	</div>
	<?php get_sidebar('filter'); ?>
</div><!-- End column2 -->
<?php
		endif;
	endif;
?>
