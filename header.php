<!DOCTYPE html>
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>"/>
<link href="<?php bloginfo('template_directory'); ?>/css/style_grid.css" rel="stylesheet" type="text/css" />

<!--WP Head-->
<?php wp_head(); ?>
<!--End of WP Head-->

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.slides.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script>
	$(document).ready(function(){
		$(".when-hidden").click(function(){
			$("#slidecontent").slideDown();
			$(this).hide();
			$(".when-shown").show();
			$(".shadow-header").show();
		})
	
		$(".when-shown").click(function(){
			$("#slidecontent").slideUp();
			$(this).hide();
			$(".when-hidden").show();
			$(".shadow-header").hide();
		})

		$('.back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
		})


		$(".expand-comments").click(function(){
			$(".comment-box").slideDown();
			$(this).hide();
			$(".collapse-comments").show();
		})

		$(".collapse-comments").click(function(){
			$(".comment-box").slideUp();
			$(this).hide();
			$(".expand-comments").show();
		})


		$(".expand-observer-info").click(function(){
			$(".observer-info").slideDown();
			$(this).hide();
			$(".collapse-observer-info").show();
		})

		$(".collapse-observer-info").click(function(){
			$(".observer-info").slideUp();
			$(this).hide();
			$(".expand-observer-info").show();
		})

		$(".expand-researcher-info").click(function(){
			$(".researcher-info").slideDown();
			$(this).hide();
			$(".collapse-researcher-info").show();
		})

		$(".collapse-researcher-info").click(function(){
			$(".researcher-info").slideUp();
			$(this).hide();
			$(".expand-researcher-info").show();
		})

		$(".expand-theme-info").click(function(){
			$(".theme-info").slideDown();
			$(this).hide();
			$(".collapse-theme-info").show();
		})

		$(".collapse-theme-info").click(function(){
			$(".theme-info").slideUp();
			$(this).hide();
			$(".expand-theme-info").show();
		})


		$(".expand-topic-filter").click(function(){
			$(".topic-filter").slideDown();
			$(this).hide();
			$(".collapse-topic-filter").show();
		})

		$(".collapse-topic-filter").click(function(){
			$(".topic-filter").slideUp();
			$(this).hide();
			$(".expand-topic-filter").show();
		})

		$(".expand-author-filter").click(function(){
			$(".author-filter").slideDown();
			$(this).hide();
			$(".collapse-author-filter").show();
		})

		$(".collapse-author-filter").click(function(){
			$(".author-filter").slideUp();
			$(this).hide();
			$(".expand-author-filter").show();
		})

		$(".expand-quarter-filter").click(function(){
			$(".quarter-filter").slideDown();
			$(this).hide();
			$(".collapse-quarter-filter").show();
		})

		$(".collapse-quarter-filter").click(function(){
			$(".quarter-filter").slideUp();
			$(this).hide();
			$(".expand-quarter-filter").show();
		})
		
		$(".expand-nav").click(function(){
			$(this).parents(".nav-box").find(".nav-collapse-content").slideDown();
			$(this).hide();
			$(this).parent().find(".collapse-nav").show();
		})


		$(".collapse-nav").click(function(){
			$(this).parents(".nav-box").find(".nav-collapse-content").slideUp();
			$(this).hide();
			$(this).parent().find(".expand-nav").show();
		})
	})

</script>

<script type="text/javascript">
function add_favorite(){
	if (document.all){
		window.external.AddFavorite("http://cnpolitics.org/","政见CNpolitics");
	}
	else if (window.sidebar){
		window.sidebar.addPanel("政见CNpolitics","http://cnpolitics.org/", "");
	}
}

</script>
<!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
<script>
    $(function() {
      $('.additional-img1').slidesjs({
        width: 180,
        height: 180,
        navigation:false
      });
      $('.additional-img2').slidesjs({
        width: 120,
        height: 180,
        navigation:false
      });
    });
</script>
<!-- End SlidesJS Required -->

</head>
<body>
<div id="container">
<div id="header">
	<div id="logo" style="cursor:pointer;" onclick="location.href='<?php bloginfo('siteurl'); ?>';"></div><!--/logo-->
	<div class="shadow"></div>
	<div id="slidecontent">
		<div id="search">
		<form style="display:inline" method="get" action="<?php bloginfo('siteurl'); ?>/">
			<input type="text" name="s" value="搜索" onblur="if (this.value==''){this.value='搜索'}" onfocus="if (this.value=='搜索') {this.value=''}" class="topsearch_input"/>
			<input type="image" class="topsearch_img" src="<?php bloginfo('template_directory'); ?>/images/search.png"/>
		</form>
		</div>
		<div id="nav">
			<div class="grid_5"><a href="#"><b>文章分类</b></a><br><br>
				<?php cnpolitics_list_category(); ?>
			</div>
			<div class="grid_4"><a href="<?php bloginfo('wpurl'); ?>/researcher/"><b>谁在研究中国</b></a><br><br>
				<?php cnpolitics_list_region();?>
			</div>
			<div class="grid_3"><a href="<?php bloginfo('wpurl'); ?>/topic/"><b>研究主题</b></a><br><br>
				<?php cnpolitics_list_toptopic();?>
			</div>
		</div><!--Nav-->
	</div><!--slidecontent-->

	<div class="clear"></div>
	<div class="when-shown"><p style="padding-top:20px;">隐藏导航</p></div>
	<div class="shadow-header" style="margin-top:-41px;"></div>
	<div class="when-hidden"><p style="padding-top:5px;">展开导航</p></div>
</div><!--/header-->
