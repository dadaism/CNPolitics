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

	$(".comment-click").click(function(){
		if ( $(".comment-body").css("display")=="none" ) {
				$(".comment-body").slideDown();
				$(".expand-comments").hide();
				$(".collapse-comments").show();
				$( "#uyan_cmt_tit" ).text("选择评分");
			}
			else if ( $(".comment-body").css("display")=="block" ) {
				$(".comment-body").slideUp();
				$(".collapse-comments").hide();
				$(".expand-comments").show();
			}
	})
});