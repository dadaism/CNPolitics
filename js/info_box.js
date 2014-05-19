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
			$(this).siblings(".researcher-info").slideDown();
			$(this).hide();
			$(this).siblings(".collapse-researcher-info").show();
		})

		$(".collapse-researcher-info").click(function(){
			$(this).siblings(".researcher-info").slideUp();
			$(this).hide();
			$(this).siblings(".expand-researcher-info").show();
		})

		$(".expand-theme-info").click(function(){
			$(this).siblings(".theme-info").slideDown();
			$(this).hide();
			$(this).siblings(".collapse-theme-info").show();
		})

		$(".collapse-theme-info").click(function(){
			$(this).siblings(".theme-info").slideUp();
			$(this).hide();
			$(this).siblings(".expand-theme-info").show();
		})
	})