<?php
/*
Template Name: Static
*/
?>
<?php  get_header();?>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/static_page.js"></script>
<style type="text/css">
@import url("<?php bloginfo('template_directory');?>/css/static_page.css");
</style>

<?php
	global $cnpolitics_dir;
	if ( isset($_GET['static_page']) ) :
		//echo 	$_GET['static_page'];
		include_once($cnpolitics_dir."/inc/".$_GET['static_page']);
	endif;
?>
<?php get_footer(); ?>
