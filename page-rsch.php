<?php
/*
Template Name: Researcher
*/
?>
<?php  get_header();?>
<?php
	if ( isset($_GET['rsch_id']) ) :
		require_once('single-rsch.php');

//	elseif ( isset($_GET['region']) ) :
//		require_once('region-researcher.php');
		
	else :
?>

<div id="column1" class="grid_6">
<div>按照主题浏览</div>
<?php
	global $wpdb;
	global $regions;
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	$reg = 1;	// region id
	foreach ($regions as $value) {
		$sql = "SELECT id, name
				FROM {$wpdb->prefix}rsch WHERE region = $reg";
		$rschs = $wpdb->get_results($sql);
		//var_dump($rschs);
		echo	'<div><a href="'.get_bloginfo('siteurl').'/researcher/?region='.$reg.'">'.$value.'</a>
					<ul>';
		foreach ( $rschs as $r ) {
			echo	'<li style="margin:10px;display:inline-block;"><a href="'.get_bloginfo('siteurl').'/researcher/?rsch_id='.$r->id.'">'.$r->name.'</a></li>';
		}
		echo	'	</ul>
				</div>';
		++$reg;
	}
?>
</div>
<?php

	endif;
?>

<div class="clear"></div>
<?php get_footer(); ?>
