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
		if ( empty($t->img_path) )
			 $t->img_path = '/images/default-thumb.png';
		echo '	<div id="researcher-avatar">
					<img src="'.get_bloginfo('template_directory').$t->img_path.'">
					<p style="margin-top:15px;">'.$t->subject.'</p>
				</div>
				<div id="column1" class="grid_6">
				<div class="researcher-intro">
					<p><span style="font-weight:bolder;color:#000;line-height:50px;">主题简介</b></p>'.
					nl2p($t->intro, false).
				'</div>
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
								$display = get_display_name($r->name, 10);
								echo '<li><a href="'.get_bloginfo('url')."/researcher/?rsch_id=".$r->id.'">'.$display. '</a> </li>';
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
				<div><a href="#" style="font-size:13px;color:#b9b9b9;font-weight:300;">全部政见 / </a> 
					<span style="font-size:15px;color:#000;font-weight:bold;">'.$t->subject.'</span>
				</div>';

	// get post id via topic_id
	$pid_array = get_postid_bytopicid($tid);
	global $issue_array;	
	global $authorid_array;
	global $quarter_array;

	$issue_array = get_issues_bypostids($pid_array);
	$authorid_array = get_authorids_bypostids($pid_array);
	$quarter_array = get_quarters_bypostids($pid_array);

	$pid_array = pid_filter($pid_array, $issue, $authorid, $quarter);
	if ( !empty($pid_array) ) {
		// The Loop
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array('paged' => $paged, 'post__in' => $pid_array );
		query_posts($args);

		/* the loop */
		if (have_posts()) :
			// put the theme options here
			global $cnpolitics_theme_dir;
			require_once( $cnpolitics_dir.'/inc/article_inc.php' );
		else:
		// No posts found
		endif;
	}
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
		<a href="<?php echo $cnpolitics_url.'/topic/?topic_id='.$t->id;?>" style="float:right;position:relative;color:#b9b9b9;font-size:13px;">« 全部<?php echo $t->subject;?></a>
	</div>
	<?php get_sidebar('filter'); ?>
</div><!-- End column2 -->
<?php
		endif;
	endif;
?>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/abstract.js"></script>