<?php

if ( isset($_GET['toptopic']) ) :
	global $wpdb;
	global $toptopics;
	$cat = $_GET['toptopic']; 	// category id
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	$sql = "SELECT id, subject, intro
			FROM {$wpdb->prefix}topics WHERE category = $cat";
	$topics = $wpdb->get_results($sql);
	if ( empty($topics) ) :
		require_once('404.php');
	else :
		echo '	<div>'.$toptopics[$cat].'</div>
				<div>
					<ul>';
		foreach ( $topics as $t ) {
			echo '	<li style="margin:10px;">
						<a href="'.get_bloginfo('siteurl').'/topic/?topic_id='.$t->id.'">'.$t->subject.'</a>
					</li>';
		}
		echo '		</ul>
				</div>';
	endif;
endif;

?>
