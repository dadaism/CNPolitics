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
                'title': "search results",
                'href': $form.attr("action") + "?" + $form.serialize(),
                'type': 'iframe',
                'padding':0,
        	});
        	return false;
		});
	})

</script>
<!-- Add favorite -->
<script type="text/javascript">
function add_favorite() {
	if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
        window.sidebar.addPanel(document.title,window.location.href,'');
    } else if(window.external && ('AddFavorite' in window.external)) { // IE Favorite
    	window.external.AddFavorite(location.href,document.title); 
    } else if(window.opera && window.print) { // Opera Hotlist
    	this.title=document.title;
        return true;
    } else { // webkit - safari/chrome ＋ Firefox >=23.0
    	alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
    }
}
</script>
<!-- End add favorite -->
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

<!-- Set up fancybox -->
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
            	    	'background' : 'rgba(58, 42, 45, 0.95)',
            		}
        		}
    		}
		});
	});
</script>
<!-- End fancybox -->
</head>
<body>
<div id="container" style="margin-bottom:70px;">
