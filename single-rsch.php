<?php
if ( isset($_GET['rsch_id']) ) :
	global $wpdb;
	global $sexes;
	$rid = $_GET['rsch_id']; 	// researcher id
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);

	$r = get_rsch_byID($rid);
	$topics = get_topic_byrsch($rid);

	if ( empty($r) ) :
		echo '<h2>你所要找的研究者不存在！</h2>';
		require_once('404.php');
	else :
		//$r = $rschs['0'];
		if ( $r->sex==NULL )
			$r->sex = 0;
		$gender = $sexes;
		//var_dump($r);	<p><span style="font-weight:bolder;color:#000;">出生：</span>1963 年（50 岁）</p>
		$year = substr($r->birth, 0, 4);
		if ( $year == '0000' ) {
			$birth = "未知";			
		}
		else {
			$age = date('Y') - $year;
			$birth = $year." 年 ($age 岁)";
		}
		echo '	<div id="researcher-avatar">
					<img src="'.get_bloginfo('template_directory').$r->img_path.'">
					<p style="margin-top:15px;">'.$r->name.'</p>
					<p style="font-weight:normal;font-size:14px;color:#b9b9b9;">'.$r->alias.'</p>
				</div>
				<div id="column1" class="grid_6">
					<div class="researcher-intro">
						<p><span style="font-weight:bolder;color:#000;">性别：</span>'.$gender[$r->sex].'</p>
						<p><span style="font-weight:bolder;color:#000;">出生：</span>'.$birth.'</p>
						<p><span style="font-weight:bolder;color:#000;">现职：</span>'.$r->title.'</p>
						<p><span style="font-weight:bolder;color:#000;line-height:50px;">相关经历</b></p>';
		$exps = explode("；", $r->experience);
		if ( empty($exps) )
			echo '			<p></p>';
		else {
			foreach ( $exps as $exp ) {
				echo '		<p>'.$exp.'</p>';
			}
		}
		echo '				<p><span style="font-weight:bolder;color:#000;line-height:50px;">个人简介</b></p>
						<p>'.$r->intro.'</p>
						<ul><span style="font-weight:bolder;color:#000;line-height:50px;">代表作品</span>';
						$reps = explode("，", $r->rep); //var_dump($rep);
						foreach ( $reps as $rep ) {
							echo '<li><a href="">'.$rep.'</a></li>';
						}
		echo '			</ul>
					</div>
				</div><!-- End column1 -->

				<div id="column2" class="prefix_7 grid_4.1">
				<div class="researcher-topic">
					<p>
					<span style="color:#000;font-weight:bolder;line-height:50px;">研究主题</span>
					</p>
					<ul>';
						if ( !empty($topics) ) {
							$count = 0;
							foreach ( $topics as $t ) {
								//echo '<li style="margin-top:20px;">'.$topic.'</li>';
								echo '<li><a href="'.get_bloginfo('url')."/topic/?topic_id=".$t->id.'">'.$t->subject.'</a></li>';
								$count = $count + 1;
								//if ( $count == 4 )	break;
							}
						}
		echo '
					</ul>
				</div>
				</div><!-- End column2 -->
			<div class="clear"></div>';

?>
<div id="display_bar">
	<img src="<?php bloginfo('template_directory'); ?>/images/shadow_middle.png">
</div>

<div id="column1" class="grid_7">
	<div><a href="#" style="font-size:13px;color:#b9b9b9;font-weight:300;"><b>全部政见/</b></a> 
		<span style="font-size:15px;color:#000;font-weight:bold;"><?php echo $r->name;?></span>
	</div>
<?php 
	// get post id via rsch_id

	$pid_array = get_postid_byrschid($rid);
	global $authorid_array;
	$authorid_array = get_authorid_bypostid($pid_array);
	global $issue_array;
	//$issue_array = array("次贷危机" , "中东局势", "亚洲策略");
	//$issue_array =  get_issueid_bypostid($pid_array);
	//var_dump($pid_array);
	$issue_array = get_issues_bypostids($pid_array);
	var_dump($issue_array);
	global $quarter_array;
	$quarter_array = get_quarter_bypostid($pid_array);

	$pid_array = pid_filter($pid_array, $authorid, $quarter);


/*
	$args = array(	'post__in' => $pid_array );
	$postslist = get_posts($args);

	foreach ($postslist as $post):
		setup_postdata($post);
		$post_thumbnail_id = get_post_thumbnail_id();
		echo '<div class="article-latest">
				<img class="latest-img" width="150" height="150" src="'.wp_get_attachment_thumb_url( $post_thumbnail_id ).'">
				<div class="latest-text">';
		echo '		<p class="latest-head"><a href="'.get_permalink().'">'.get_the_title().'</a></p>
					<p class="latest-author"><a href="#">'.get_the_author().'</a><span style="font-size:13px;color:#b9b9b9;"> | '.get_the_date('Y-m-d').'</span></p>
					<div class="box-abstract">
						<p class="latest-abstract">'.get_excerpt('96').'</p>
					</div>		
				</div>
			</div>
			<div class="clear"></div>';
	endforeach;
*/
	if ( !empty($pid_array) ) {
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
		else :
			// No posts found
		endif;
	}
?>
<div class="pagination"><?php wp_pagenavi(); ?></div>
<div class="post-end-button back-to-top">
	<p style="padding-top:20px;">回到开头</p>
</div>
<div id="display_bar">
	<img width="556px;" src="<?php bloginfo('template_directory'); ?>/images/shadow-post-end.png">
</div>
<div><p style="text-align:center; color:#b9b9b9;">1</p></div>
</div> <!-- End column1 -->

<div id="column2" class="prefix_1 grid_4">	
	<div style="margin-bottom:40px;">
		<a href="#" style="float:right;position:relative;color:#b9b9b9;font-size:13px;">« 全部关于<?php echo $r->name;?></a>
	</div>
	<?php get_sidebar('filter'); ?>
</div><!--column2-->

<?php
	endif;
endif;

?>

