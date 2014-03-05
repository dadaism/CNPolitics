	$(document).ready(function(){
		$(".img-hover").hover(function() {
			var src_url = $(this).attr("src").replace(".png", "-hover.png");
			$(this).attr("src", src_url);
				}, function() {
			var src_url = $(this).attr("src").replace("-hover", "");
			$(this).attr("src", src_url);
		});
	});