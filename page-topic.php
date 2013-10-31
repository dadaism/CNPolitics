<?php
/*
Template Name: Topic
*/
?>
<?php  get_header();?>
<?php
	if ( isset($_GET['topic_id']) ) :
		$authorid = isset($_GET['authorid']) ? $_GET['authorid'] : '';
		$quarter = isset($_GET['quarter']) ? $_GET['quarter'] : '';
		require_once('single-topic.php');

		echo '<script>
				var authorid = '.json_encode($authorid).';
				var quarter = '.json_encode($quarter).';
				decorate_filter_box(authorid, quarter);
			  </script>';
	//elseif ( isset($_GET['toptopic']) ) :
	//	require_once('category-topic.php');
	else :
?>
<div id="column1" class="grid_6">
<div>按照主题浏览</div>
<?php
	global $wpdb;
	global $toptopics;
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	$numItems = count($toptopics);
	$cat = 1;	// category id
	foreach ($toptopics as $value) {
		$sql = "SELECT id, subject, ordering
				FROM {$wpdb->prefix}topics WHERE category = $cat";
		$topics = $wpdb->get_results($sql);
		echo	'<div><a href="'.get_bloginfo('siteurl').'/topic/?toptopic='.$cat.'">'.$value.'</a>
					<ul>';
		foreach ( $topics as $t ) {
			echo	'<li style="margin:10px;display:inline-block;" ><a href="'.get_bloginfo('siteurl').'/topic/?topic_id='.$t->id.'">'.$t->subject.'</a></li>';
		}
		echo	'	</ul>
				</div>';
		++$cat;
	}
?>
</div>
<?php

	endif;
?>

<div class="clear"></div>
<?php get_footer(); ?>
