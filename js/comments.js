$(document).ready(function(){
	$(".expand-comments").click(function(){
		$(".comment-body").slideDown();
		$(this).hide();
		$(".collapse-comments").show();
		$( "#uyan_cmt_tit" ).text("选择评分");
	})

	$(".collapse-comments").click(function(){
		$(".comment-body").slideUp();
		$(this).hide();
		$(".expand-comments").show();
	})

/*
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
*/
});