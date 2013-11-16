<!DOCTYPE html>
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' );?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style_grid.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />


<!--WP Head-->
<?php wp_head(); ?>
<!--End of WP Head-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.slides.min.js"></script>
<script type="text/javascript"  src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

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
		
		/* Search Box */
		$("#search_form").bind("submit", function(){
			$form = $(this);

    		$.fancybox({
                'title': "form submission",
                'href': $form.attr("action") + "?" + $form.serialize(),
                'type': 'iframe'
        	});

        	return false;

		});
		/*$("input[type=text].topsearch_input").click(function() {
    		alert("haha");
			$.open({
				href : 'http://www.google.com',
				type : 'iframe',
				padding : 5
			});
		});

		$("input[type=image].topsearch_img").click(function() {
			
    		$('<a href="http://www.google.com">Friendly description</a>').fancybox({
    			overlayShow: true
   			 }).click();
		});*/
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

<script>
	$(document).ready(function() {
		$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif']").attr('rel', 'gallery').fancybox({
			'autoSize': false,
			'autoDimensions': false,
			'autoScale'	: false,
			'fitToView': false,
			helpers : {
        		overlay : {
            		css : {
            	    	'background' : 'rgba(58, 42, 45, 0.95)'
            		}
        		}
    		}
		});
	});
</script>

</head>
<body>
<div id="container">
