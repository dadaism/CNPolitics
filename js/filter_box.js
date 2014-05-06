$(document).ready(function(){
	$(".filter-header").click(function(){
		if ( $(this).parent(".post-filter-box").find(".filter-content").css("display")=="none" ) {
				$(this).parent(".post-filter-box").find(".filter-content").slideDown();
				$(this).find(".expand-filter").hide();
				$(this).find(".collapse-filter").show();
			}
			else if ( $(this).parent(".post-filter-box").find(".filter-content").css("display")=="block" ) {
				$(this).parent(".post-filter-box").find(".filter-content").slideUp();
				$(this).find(".collapse-filter").hide();
				$(this).find(".expand-filter").show();
			}
	})
});