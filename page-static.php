<?php
/*
Template Name: Static
*/
?>
<?php  get_header();?>
<?php
	if ( isset($_GET['static_page']) ) :
		echo 	$_GET['static_page'];
		include_once($_GET['static_page']);
	endif;
?>
<?php get_footer(); ?>
<script>
	$(document).ready(function(){
		$('.language-toggle').click(function()	{
			if (!$(this).hasClass('active') & $(this).hasClass('english')) {
				$('#copyright-cn').css('display','none');
				$('#copyright-en').css('display','block');
			}

			else if (!$(this).hasClass('active') & $(this).hasClass('chinese')) {
				$('#copyright-cn').css('display','block');
				$('#copyright-en').css('display','none');
			}
		})

	})
</script>

<style type="text/css">
.clear1	{clear: both;height:0;} 

#join-nav {
	margin:0 auto; text-align: center; padding-bottom: 10px;
	background-image:url(images/background_pattern.png);
}

#join-nav p { font-size:24pt;margin:0 auto; padding:40px 0 10px 0;font-weight:bold;}
#join-nav ul li {display: inline;color:#b9b9b9;}
#join-nav ul li a {font-size:14px; color: b9b9b9;}
#join-head p { font-size:16px; color: 3b3b3b;}
#join-head a { color: #b42800; font-weight: bold;}

.join-position { 
	margin-top: 80px;
	text-align: center; 
	font-size: 18px; 
	font-weight:bold; 
}

.join-body p { font-size: 16px; color: #3b3b3b;}
.join-body a { color: #b42800;}

.join-contact {
	width: 340px;
	margin-top: 30px;
	margin-left: auto;
	margin-right: auto;
	padding-top: 20px;
	padding-bottom: 20px;
/*	border-style:solid;*/
}

.join-contact p { 
	text-align: center; 
	font-size:15px; 
	color:#777777;
}

.join-contact a {color: #b42800;}


/*_______COPYRIGHT*/


.copyright-content {padding-bottom: 10px;}

.copyright-content p {
	color:#3b3b3b;
	font-size: 16px;
	line-height: 28px;
	margin-bottom: 15px;
}

.copyright-content p.about-title {
	color:#000000;
	font-size: 18px;
	font-weight: bold;
	text-align: center;
	margin:20px auto;
	
}

#copyright-en, #copyright-cn {
	padding:0 22;
}
.copyright-item {
	margin-top: 20px;
	//border: 1px solid red;
	height: auto;
}

.copyright-item span {font-weight: bold;}

.img-item {
	width:36px;
	height: auto;
	float: left;
}

.content-item {
	width:520px;
	margin-left: 20px;
	padding-top: 5px;
	float: left;
	font-size: 16px;
}

.copyright-contact {margin-top: 30px;}
.copyright-contact {font-size: 16px;}

#copyright-head .head {
	color:#000000;
	font-size:24px;
	margin-top:15px;
	font-weight: bold;
}

#copyright-head .subhead {
	font-size:16px; 
	font-weight:bold;
	line-height: 30px;
}

#copyright-head li {
	display: inline; 
	font-size:13px;
}

a {
	color: #b42800;
}

#copyright-en p {
	font-size: 15px;
	color:#3b3b3b;
	line-height: 24px;
	margin-bottom: 10px;

}

#copyright-en ul, #copyright-cn ul {
	margin:30px auto; padding-left: 0px;
}


li.language-toggle {
	font-size: 14px; 
	color:#b9b9b9;
}

li.language-toggle.active {
	color: #777777; font-weight: bold;
}

li.language-toggle.inactive {
	cursor: pointer;
}

.contribute {
	margin-top: 40px;
}

#copyright-cn .contribute p {
	font-size: 15px;
	color:#777777;
	text-align: center;
	margin-bottom: 2px;
}

#copyright-en .contribute p {
	font-size: 14px;
	color:#777777;
	text-align: center;
	margin-bottom: 2px;
}
</style>
