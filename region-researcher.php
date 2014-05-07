<?php

if ( isset($_GET['region']) ) :
	global $wpdb;
	global $regions;
	$reg = $_GET['region']; 	// region id
	$sql = "SELECT id, name
			FROM {$wpdb->prefix}rsch WHERE region = $reg";
	$rschs = $wpdb->get_results($sql);
	if ( empty($rschs) ) :
		require_once('404.php');
	else :
		echo '	<div>'.$regions[$reg].'</div>
				<div>
					<ul>';
		foreach ( $rschs as $r ) {
			echo '	<li style="margin:10px;">
						<a href="'.get_bloginfo('siteurl').'/researcher/?rsch_id='.$r->id.'">'.$r->name.'</a>
					</li>';
		}
		echo '		</ul>
				</div>';
	endif;
endif;
?>
