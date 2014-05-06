<!DOCTYPE html>
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title>
<?php 
	if ( is_home() ) {
		echo get_bloginfo('name').' - '.get_bloginfo('description');
	}
	else if ( is_page_template('page-static.php') && isset($_GET['static_page']) ) {
		if ( "about.php" == $_GET['static_page'] )
			echo "关于政见";
		else if ( "copyright.php" == $_GET['static_page'] )
			echo "版权声明";
		else if ( "coop.php" == $_GET['static_page'] )
			echo "交流合作";
		else if ( "join_us.php" == $_GET['static_page'] )
			echo "加入我们";
		else if ( "team.php" == $_GET['static_page'] )
			echo "团队成员";

		echo ' | '.get_bloginfo('name');
	}
	else if ( is_page_template('page-rsch.php') && isset($_GET['rsch_id']) ) {
		$rid = $_GET['rsch_id']; 	// researcher id
		$r = get_rsch_byID($rid);
		echo $r->name.' | '.get_bloginfo('name');
	}
	else if ( is_page_template('page-topic.php') && isset($_GET['topic_id']) ) {
		$tid = $_GET['topic_id']; 	// topic id
		$t = get_topic_byID($tid);
		echo $t->subject.' | '.get_bloginfo('name');
	}
	else {
		wp_title('|', true, 'right');
		echo get_bloginfo('name');
	}
?> 
</title>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' );?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style_grid.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" ></link>

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
			$("body,html").animate({
				scrollTop: 0
			}, 400);
		})

		$(".nav-header").click(function(){
			if ( $(this).parent(".nav-box").find(".nav-collapse-content").css("display")=="none" ) {
				$(this).parent(".nav-box").find(".nav-collapse-content").slideDown();
				$(this).find(".expand-nav").hide();
				$(this).find(".collapse-nav").show();
			}
			else if ( $(this).parent(".nav-box").find(".nav-collapse-content").css("display")=="block" ) {
				$(this).parent(".nav-box").find(".nav-collapse-content").slideUp();
				$(this).find(".collapse-nav").hide();
				$(this).find(".expand-nav").show();
			}
		})
		
		$('.back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
		})
/*
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
*/
		/* search shadow on focus */
		$(".topsearch_input").focus(function() {
  			//$('input[type="image"].topsearch_img_shadow').css("margin", '28px 0 0 -329px');
  			//var src_url = $('input[type="image"].topsearch_img_shadow').attr("src").replace(".png", "-hover.png");
  			//$('input[type="image"].topsearch_img_shadow').attr("src", src_url);
//  			$('.front-search-box-shadow').css("margin", '-5px auto auto auto');
  			$('.front-search-box-shadow').removeClass('front-search-box-shadow').addClass('front-search-box-shadow-hover');
  			$('#box-sample').css('width','300px');
  			$(this).css('width','260px');
		});

		$(".topsearch_input").blur(function() {
  			//$('input[type="image"].topsearch_img_shadow').css("margin", '28px 0 0 -172px');
  			//var src_url = $('input[type="image"].topsearch_img_shadow').attr("src").replace("-hover", "");
  			//$('input[type="image"].topsearch_img_shadow').attr("src", src_url);
//  			$('.front-search-box-shadow-hover').css("margin", '-5px auto auto auto');
			setTimeout(function(){
				$('.front-search-box-shadow-hover').removeClass('front-search-box-shadow-hover').addClass('front-search-box-shadow');
  				$('#box-sample').css('width','150px');
  				$('.topsearch_input').css('width','110px');
			}, 200);
		});

		

		/* Search Box */
		$("#search_form").bind("submit", function(){

			$('.front-search-box-shadow-hover').removeClass('front-search-box-shadow-hover').addClass('front-search-box-shadow');
			var mHeight = $( window ).height();
			$form = $(this);
    		$.fancybox({
            /*    'title': "search results",  */
                'href': $form.attr("action") + "?" + $form.serialize(),
                'type': 'iframe',
                'margin': 0,
                'padding': 0,
                'width': 660,
                'minHeight': mHeight,
                'topRatio': 0,
                tpl: {
                	wrap     : '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
        			/*closeBtn: '<a title="Close" style="top:20px; right:20px;" class="fancybox-item fancybox-close" href="javascript:;"></a>'*/  				
        			closeBtn: '<a title="Close" style="top:20px; right:20px;" class="close" href="javascript:;"></a>'
        		},
  				'afterLoad': function() {
   				//	alert( $("div.fancybox-wrap").css("top") ); 
      			//	$("div.fancybox-wrap").css({'top':'0px !important', 'bottom':'0px'});
      				//alert( $(".fancybox-inner").css("top") ); 
   				},
   				helpers : {
        			overlay : {
            			css : {
            	  		  	'background-color' : 'rgba(0, 0, 0, 0.25)',
            	  		  	'background-image' : 'none',
            			}
        			}
    			},
    			beforeShow: function() {
        			var newWidth = 250; // set new image display width
        			$(".fancybox-inner").css({
            			width  : newWidth,
            			height : "auto"
        			}); // apply new size to img
        			// optionally :
     	   			// set new values for parent container IF you want to match the image size
        			// this.width  = newWidth;
        			// this.height = $(".fancybox-inner img").innerHeight();
   				}
        	});
        	return false;
		});
		
		/* hover on image */
		$(".img-hover").hover(function() {
			var src_url = $(this).attr("src").replace(".png", "-hover.png");
			$(this).attr("src", src_url);
				}, function() {
			var src_url = $(this).attr("src").replace("-hover", "");
			$(this).attr("src", src_url);
		});

		/* footer subscribe */
		$(".footer-emailbox-input" ).focus(function() {
  			var src_url = $('input[type="image"].footer-emailbox-img').attr("src").replace(".png", "_light.png");
  			$('input[type="image"].footer-emailbox-img').attr("src", src_url);
		});
		$(".footer-emailbox-input" ).blur(function() {
  			var src_url = $(".footer-emailbox-img").attr("src").replace("_light", "");
  			$('input[type="image"].footer-emailbox-img').attr("src", src_url);
		});
		/* sidebar subscribe */
		$(".post-sidebar-emailbox-input" ).focus(function() {
			var src_url = $(".sidebar-emailbox-img").attr("src").replace(".png", "_light.png");
  			$('input[type="image"].sidebar-emailbox-img').attr("src", src_url);
		});
		$(".post-sidebar-emailbox-input" ).blur(function() {
  			var src_url = $('input[type="image"].sidebar-emailbox-img').attr("src").replace("_light", "");
  			$('input[type="image"].sidebar-emailbox-img').attr("src", src_url);
		});

		if ( $(".pagination").length != 0 ) {
			if ( $(".pagination").children(".next").length != 0 ) {
				$(".pagination").children(".next").prev().addClass("last-number");
			}
			else {
				$(".pagination").children("span.current").addClass("last-number");
			}
		}
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
			'width':660,
			'autoScale'	: false,
			'fitToView': false,
			helpers : {
        		overlay : {
            		css : {
            	    	'background' : 'rgba(0, 0, 0, 0.5)',
            		}
        		}
    		}
		});

	});
</script>
<!-- End fancybox -->
</head>
<body>
<div id="deco-top">
	<div class="grey"></div>
	<div class="white"></div>
</div>
<div id="container">
