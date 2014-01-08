	$(document).ready(function(){
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
	})