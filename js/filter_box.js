$(document).ready(function(){
	$(".expand-topic-filter").click(function(){
		$(".topic-filter").slideDown();
		$(this).hide();
		$(".collapse-topic-filter").show();
	})

	$(".collapse-topic-filter").click(function(){
		$(".topic-filter").slideUp();
		$(this).hide();
		$(".expand-topic-filter").show();
	})

	$(".expand-author-filter").click(function(){
		$(".author-filter").slideDown();
		$(this).hide();
		$(".collapse-author-filter").show();
	})

	$(".collapse-author-filter").click(function(){
		$(".author-filter").slideUp();
		$(this).hide();
		$(".expand-author-filter").show();
	})

	$(".expand-quarter-filter").click(function(){
		$(".quarter-filter").slideDown();
		$(this).hide();
		$(".collapse-quarter-filter").show();
	})

	$(".collapse-quarter-filter").click(function(){
		$(".quarter-filter").slideUp();
		$(this).hide();
		$(".expand-quarter-filter").show();
	})
});