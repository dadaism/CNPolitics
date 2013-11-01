<?php
/*
Template Name: Static
*/
?>
<?php  get_header();?>
<?php
	if ( isset($_GET['static_page']) ) :
		require_once($_GET['static_page']);
	endif;
?>
<div class="clear"></div>
<?php get_footer(); ?>
