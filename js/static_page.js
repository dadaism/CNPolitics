$(document).ready(function(){
	$('.language-toggle').click(function()	{
		if (!$(this).hasClass('active') & $(this).hasClass('english')) {
			if ( $('#about-head').length ) {
				$('#about-cn').css('display','none');
				$('#about-en').css('display','block');
			}
			if ( $('#copyright-head').length ) {
				$('#copyright-cn').css('display','none');
				$('#copyright-en').css('display','block');
			}
			if ( $('#tos-head').length ) {
				$('#tos-cn').css('display','none');
				$('#tos-en').css('display','block');
			}
		}
		else if (!$(this).hasClass('active') & $(this).hasClass('chinese')) {
			if ( $('#about-head').length ) {
				$('#about-cn').css('display','block');
				$('#about-en').css('display','none');
			}
			if ( $('#copyright-head').length ) {
				$('#copyright-cn').css('display','block');
				$('#copyright-en').css('display','none');
			}
			if ( $('#tos-head').length ) {
				$('#tos-cn').css('display','block');
				$('#tos-en').css('display','none');
			}
		}
	})
	$(".join-nav-obs").click(function() {
		var heightObs = $("#join-observer").offset().top-110;
		$('html,body').animate({
			scrollTop: heightObs
		},300,function() {});
		window.location.hash='observer';
	})

	$(".join-nav-gra").click(function() {
		var heightGra = $("#join-graphic").offset().top-110;
		$('html,body').animate({
			scrollTop: heightGra
		},300,function() {});
		window.location.hash='graphic';
	})

	$(".join-nav-ops").click(function() {
		var heightOps = $("#join-operation").offset().top-110;
		$('html,body').animate({
			scrollTop: heightOps
		},300,function() {});		
		window.location.hash='operation';
	})

	$(".join-nav-des").click(function() {
		var heightDes = $("#join-design").offset().top-110;
		$('html,body').animate({
			scrollTop: heightDes
		},300,function() {});		
		window.location.hash='design';
	})

	$(".join-nav-eng").click(function() {
		var heightEng = $("#join-engineer").offset().top-110;
		$('html,body').animate({
			scrollTop: heightEng
		},300,function() {});		
		window.location.hash='engineer';
	})

	$(".team-nav-obs").click(function() {
		var heightEng = $("#join-observer").offset().top-200;
		$('html,body').animate({
			scrollTop: heightEng
		},300,function() {});		
		window.location.hash='observer';
	})
})